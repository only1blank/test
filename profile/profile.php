<?php
require_once '../vendor/components/header.php';

// Проверяем авторизацию
if (!isset($_SESSION['user'])) {
    header("Location: ../login/login.php");
    exit();
}

// Обработка загрузки аватара
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar'])) {
    $uploadDir = '../uploads/avatars/';
    
    // Создаем директорию, если ее нет
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    $userId = $_SESSION['user']['id'];
    $fileExtension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $fileName = 'avatar_' . $userId . '.' . $fileExtension;
    $uploadPath = $uploadDir . $fileName;
    
    // Проверяем и загружаем файл
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (in_array($_FILES['avatar']['type'], $allowedTypes)) {
        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadPath)) {
            // Обновляем путь к аватару в базе данных
            $stmt = $link->prepare("UPDATE users SET avatar = ? WHERE id = ?");
            $stmt->bind_param("si", $fileName, $userId);
            $stmt->execute();
            $stmt->close();
            
            // Обновляем данные в сессии, если нужно
            $_SESSION['user']['avatar'] = $fileName;
        }
    }
}

// Получаем данные пользователя
$result = $link->query("SELECT * FROM `users` WHERE `id` = {$_SESSION['user']['id']}");
$row = $result->fetch_assoc();

// Устанавливаем значения по умолчанию
$userData = [
    'name' => $row['name'] ?? '',
    'surname' => $row['surname'] ?? '',
    'email' => $row['email'] ?? '',
    'phone' => $row['phone'] ?? '',
    'avatar' => $row['avatar'] ?? null
];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль ястреба</title>
    <link rel="icon" type="image/x-icon" href="../hawk.png">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #e30613; /* Красный цвет */
            --dark-color: #1a1a1a; /* Темный фон */
            --light-color: #ffffff; /* Белый цвет */
            --gray-color: #f5f5f5; /* Светло-серый */
        }
        
        body {
            background-color: var(--gray-color);
            color: var(--dark-color);
            font-family: 'Arial', sans-serif;
        }
        
     
      .container-profile{
        margin-top: 40px;
        margin-bottom: 20px;
  
        margin-left: 650px;
      }
        .profile__avatar-info_avatar {
            width: 180px;
            height: 180px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid var(--light-color);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        
        .profile__avatar-upload-label {
            cursor: pointer;
            display: inline-block;
            margin-top: 1rem;
        }
        
        .profile__avatar-upload-input {
            display: none;
        }
        
        .profile__avatar-upload-text {
            background-color: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: all 0.3s;
            display: inline-block;
        }
        
        .profile__avatar-upload-text:hover {
            background-color: #c00511;
        }
        
        .profile__avatar-info_info {
            margin-top: 0.5rem;
            font-weight: 500;
            color: #6c757d;
            font-size: 1.1rem;
        }
        
        .profile__info_item {
            margin-bottom: 1.2rem;
            font-size: 1.1rem;
            padding: 0.5rem;
            border-bottom: 1px solid #eee;
        }
        
        .profile__info_item strong {
            color: var(--primary-color);
        }
        
        .btn-edit {
            background-color: var(--dark-color);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: all 0.3s;
            margin-left: 0.5rem;
            font-size: 0.9rem;
        }
        
        .btn-edit:hover {
            background-color: #333;
            color: white;
        }
        
        .btn-logout {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.7rem 1.5rem;
            border-radius: 5px;
            transition: all 0.3s;
            font-weight: 500;
            margin-top: 1rem;
        }
        
        .btn-logout:hover {
            background-color: #c00511;
            color: white;
        }
        
        .modal-header {
            background-color: var(--dark-color);
            color: var(--light-color);
            border-bottom: 2px solid var(--primary-color);
        }
        
        .modal-footer {
            border-top: 1px solid #ddd;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #c00511;
            border-color: #c00511;
        }
        
        .btn-secondary {
            background-color: var(--dark-color);
            border-color: var(--dark-color);
        }
        .allfoot {
        display: flex;
        flex-direction: column;
        width: 100%;
}

.footer {
  background-color: #ffffff;
  max-height: 250px;
  border-top: 1px solid red;
  
}

.icons {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 15px;
  text-decoration: none;
  list-style: none;
}
        .edit-section {
            margin-bottom: 1.5rem;
        }
        
        .edit-section h3 {
            color: var(--primary-color);
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
   
    
    <div class="container-profile">
        <div class="profile">
            <div class="row profile_row">
                <div class="col-md-4 text-center mb-4 mb-md-0 profile__row_avatar-info">
                    <img class="profile__avatar-info_avatar" 
                         src="<?= '../uploads/avatars/'.$userData['avatar']; ?>" 
                         alt="Аватар пользователя"
                         id="avatarPreview">
                    
                    <!-- Форма для загрузки аватара -->
                   <form action="" method="post" enctype="multipart/form-data" class="profile__avatar-form">
                        <label class="profile__avatar-upload-label">
                            <input type="file" name="avatar" accept="image/jpeg,image/png,image/gif" 
                                   class="profile__avatar-upload-input" id="avatarInput">
                            <span class="profile__avatar-upload-text">Изменить фото</span>
                        </label>
                        <button type="submit" class="btn btn-primary mt-2">Сохранить</button>
                    </form>
                    
                    <div class="profile__avatar-info_info">Фанат</div>
                </div>
                
                
                <div class="col-md-8 profile__row_info">
                    <div class="edit-section">
                        <h3>Личная информация</h3>
                        <p class="profile__info_item">
                            <strong>Имя:</strong> 
                            <span data-field="name"><?= htmlspecialchars($userData['name']) ?> </span>
                            <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#editNameModal">Изменить</button>
                        </p>
                        <p class="profile__info_item">
                            <strong>Фамилия:</strong>
                            <span data-field="surname"><?= htmlspecialchars($userData['surname']) ?></span>
                            <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#editSurnameModal">Изменить</button>
                        </p>
                        <p class="profile__info_item">
                            <strong>Email:</strong> 
                            <span data-field="email"><?= htmlspecialchars($userData['email']) ?></span>
                            <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#editEmailModal">Изменить</button>
                        </p>
                        <p class="profile__info_item">
                            <strong>Телефон:</strong> 
                            <span data-field="phone"><?= htmlspecialchars($userData['phone']) ?></span>
                            <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#editPhoneModal">Изменить</button>
                        </p>
                        <p class="profile__info_item">
                            <strong>Пароль:</strong> 
                            <span data-field="password">*****</span>
                            <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Изменить</button>
                        </p>
                    </div>
                    
                    
                    <form action="../vendor/functions/logout.php" class="mt-4">
                        <button type="submit" class="btn-logout">Выйти</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Модальные окна для редактирования -->
    <!-- Изменение имени -->
   <!-- Модальное окно редактирования имени -->
<div class="modal fade" id="editNameModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Изменить имя</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="update_profile.php" method="POST" class="modal-form" id="nameForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Новое имя</label>
                        <input type="text" class="form-control" name="value" required>
                        <input type="hidden" name="field" value="name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-danger">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Модальное окно редактирования фамилии -->
<div class="modal fade" id="editSurnameModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Изменить фамилию</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="update_surname.php" method="post" class="modal-form" id="surnameForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Новая фамилия</label>
                        <input type="text" class="form-control" name="value" required>
                        <input type="hidden" name="field" value="surname">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-danger">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Модальное окно редактирования email -->
<div class="modal fade" id="editEmailModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Изменить email</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="update_email.php" method="post" class="modal-form" id="emailForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Новый email</label>
                        <input type="email" class="form-control" name="value" required>
                        <input type="hidden" name="field" value="email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-danger">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Модальное окно редактирования телефона -->
<div class="modal fade" id="editPhoneModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Изменить телефон</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="update_phone.php" method="post" class="modal-form" id="phoneForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Новый телефон</label>
                        <input type="tel" class="form-control" name="value" placeholder="+7 (___) ___-__-__" required>
                        <input type="hidden" name="field" value="phone">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-danger">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Модальное окно изменения пароля -->
<div class="modal fade" id="changePasswordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Изменение пароля</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="update_password.php" method="post" id="passwordForm" >
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Новый пароль</label>
                        <input type="text" class="form-control" name="value" required>
                        <input type="hidden" name="field" value="password">
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-danger">Изменить пароль</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Футер -->
    <div class="footer">
        <div class="allfoot">
            
            <div class="icons">
                <li><a href="https://vk.com/hc_avangardomsk"> <img src="../Line-up/icons/vk.svg" alt=""></a></li>
                <li><a href="https://t.me/s/omskiyavangard"> <img src="../Line-up/icons/tg.svg" alt=""></a></li>
                <li><a href="https://www.youtube.com/@HCAvangardTV"> <img src="../Line-up/icons/youtube.svg" alt=""></a></li>
                <li><a href="https://www.instagram.com/avangard_inside/?hl=ru"> <img src="../Line-up/icons/insta.svg" alt=""></a></li>
                <li><a href="https://apps.apple.com/us/app/%D1%85%D0%BA-%D0%B0%D0%B2%D0%B0%D0%BD%D0%B3%D0%B0%D1%80%D0%B4/id1426468334?l=ru&ls=1&utm_source=hawk&utm_medium=footer&utm_campaign=app">
                    <img src="../Line-up/icons/app-store.svg (1).svg" alt=""></a></li>
                <li><a href="https://appgallery.huawei.com/app/C109037935?utm_source=hawk&utm_medium=footer&utm_campaign=app">
                    <img src="../Line-up/icons/app-huawei.svg.svg" alt=""></a></li>
                <li><a href="https://play.google.com/store/apps/details?id=ru.hawk.app&utm_source=hawk&utm_medium=footer&utm_campaign=app">
                    <img src="../Line-up/icons/google.svg" alt=""></a></li>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        
      // Предпросмотр аватара
document.getElementById('avatarInput').addEventListener('change', function(e) {
    if (this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('avatarPreview').src = event.target.result;
        }
        reader.readAsDataURL(this.files[0]);
    }
});

// Отправка формы аватара
document.querySelector('.profile__avatar-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    fetch('update_profile.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (data.avatar) {
                document.getElementById('avatarPreview').src = '../uploads/avatars/' + data.avatar + '?t=' + new Date().getTime();
            }
            alert('Изменения сохранены!');
        } else {
            alert('Ошибка при сохранении');
        }
    });
});





function showAlert(type, message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} position-fixed top-0 end-0 m-3`;
    alertDiv.style.zIndex = '9999';
    alertDiv.textContent = message;
    document.body.appendChild(alertDiv);
    
    setTimeout(() => {
        alertDiv.remove();
    }, 3000);
}
    </script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Для каждого модального окна подставляем текущие значения
    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
        button.addEventListener('click', function() {
            const target = this.getAttribute('data-bs-target');
            const field = target.replace('#edit', '').replace('Modal', '').toLowerCase();
            const currentValue = document.querySelector(`[data-field="${field}"]`).textContent.trim();
            
            document.querySelector(`${target} input[name="value"]`).value = currentValue;
        });
    });
    
    // Инициализация маски для телефона
    if (document.getElementById('editPhoneModal')) {
        $('#editPhoneModal input[type="tel"]').mask('+7 (999) 999-99-99');
    }
});

</script>
</body>
</html>