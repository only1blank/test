const cardAddArr = Array.from(document.querySelectorAll(".card__add"));
const cartNum = document.querySelector("#cart_num");
const cart = document.querySelector("#cart");

class Cart {
  products;
  constructor() {
    this.products = [];
  }
 
  addProduct(product) {
    this.products.push(product);
  }
  removeProduct(index) {
    this.products.splice(index, 1);
  }
  get cost() {
    const prices = this.products.map((product) => {
      return toNum(product.price);
    });
    const sum = prices.reduce((acc, num) => {
      return acc + num;
    }, 0);
    return sum;
  }
}

class Product {
  imageSrc;
  name;
  price;
  constructor(card) {
    this.imageSrc = card.querySelector(".card__image").children[0].src;
    this.name = card.querySelector(".card__title").innerText;
    this.price = card.querySelector(".card__price--common").innerText;
  }
}

const myCart = new Cart();

if (localStorage.getItem("cart") == null) {
  localStorage.setItem("cart", JSON.stringify(myCart));
}

const savedCart = JSON.parse(localStorage.getItem("cart"));
myCart.products = savedCart.products;
cartNum.textContent = myCart.count;

myCart.products = cardAddArr.forEach((cardAdd) => {
  cardAdd.addEventListener("click", (e) => {
    e.preventDefault();
    const card = e.target.closest(".card");
    const product = new Product(card);
    const savedCart = JSON.parse(localStorage.getItem("cart"));
    myCart.products = savedCart.products;
    myCart.addProduct(product);
    localStorage.setItem("cart", JSON.stringify(myCart));
    cartNum.textContent = myCart.count;
  });
});


const popup = document.querySelector(".popup");
const popupClose = document.querySelector("#popup_close");
const body = document.body;
const popupContainer = document.querySelector("#popup_container");
const popupProductList = document.querySelector("#popup_product_list");
const popupCost = document.querySelector("#popup_cost");

cart.addEventListener("click", (e) => {
  e.preventDefault();
  popup.classList.add("popup--open");
  body.classList.add("lock");
  popupContainerFill();
});

function popupContainerFill() {
  popupProductList.innerHTML = null;
  const savedCart = JSON.parse(localStorage.getItem("cart"));
  myCart.products = savedCart.products;
  const productsHTML = myCart.products.map((product) => {
    const productItem = document.createElement("div");
    productItem.classList.add("popup__product");

    const productWrap1 = document.createElement("div");
    productWrap1.classList.add("popup__product-wrap");
    const productWrap2 = document.createElement("div");
    productWrap2.classList.add("popup__product-wrap");

    const productImage = document.createElement("img");
    productImage.classList.add("popup__product-image");
    productImage.setAttribute("src", product.imageSrc);

    const productTitle = document.createElement("h2");
    productTitle.classList.add("popup__product-title");
    productTitle.innerHTML = product.name;

    const productPrice = document.createElement("div");
    productPrice.classList.add("popup__product-price");
    productPrice.innerHTML = toCurrency(toNum(product.price));

    const productDelete = document.createElement("button");
    productDelete.classList.add("popup__product-delete");
    productDelete.innerHTML = "&#10006;";

    productDelete.addEventListener("click", () => {
      myCart.removeProduct(product);
      localStorage.setItem("cart", JSON.stringify(myCart));
      popupContainerFill();
    });

    productWrap1.appendChild(productImage);
    productWrap1.appendChild(productTitle);
    productWrap2.appendChild(productPrice);
    productWrap2.appendChild(productDelete);
    productItem.appendChild(productWrap1);
    productItem.appendChild(productWrap2);

    return productItem;
  });

  productsHTML.forEach((productHTML) => {
    popupProductList.appendChild(productHTML);
  });

  popupCost.value = toCurrency(myCart.cost);
}

popupClose.addEventListener("click", (e) => {
  e.preventDefault();
  popup.classList.remove("popup--open");
  body.classList.remove("lock");
});
const inner = document.querySelector('.inner')
const block = document.querySelector('.block')

const voucher = [
    {
        country: "Новинки",
        card: [
            {
                image: "../Маркет/cap.png" ,
                title: "Бейсболка",
                price: "1990Р"
                
            },
            {
                image: "../Маркет/a5.png" ,
                title: "Вымпел (А5)",
                price: "690Р"
            },
            {

                image: "../Маркет/vimpel.png" ,
                title: "Вымпел",
                price: "490Р"
            },
            {

                image: "../Маркет/sharf.png" ,
                title: "Шарф",
                price: "1290Р"
            },
            {

                image: "../Маркет/podyshka.png" ,
                title: "Подушка",
                price: "990Р"
            }
        ]
    },
    {
        country: "Популярное",
        card: [
            {

                image: "../Маркет/podyshka.png" ,
                title: "Подушка",
                price: "900Р"
            },
            {

                image: "../Маркет/sharf.png" ,
                title: "Шарф",
                price: "1290Р"
            },
            {

                image: "../Маркет/cap.png" ,
                title: "Бейсболка",
                price: "1990Р"
            },
            {

                image: "../Маркет/a5.png" ,
                title: "Вымпел (А5)",
                price: "690Р"
            },
            {

                image: "../Маркет/vimpel.png" ,
                title: "Вымпел",
                price: "490Р"
            }
        ]
    },
    {
        country: "Спецпредложения",
        card: [
          {

            image: "../Маркет/sharf.png" ,
            title: "Шарф",
            price: "1290Р"
        },
        {

            image: "../Маркет/podyshka.png" ,
            title: "Подушка",
            price: "990Р"
        },
        {

            image: "../Маркет/vimpel.png" ,
            title: "Вымпел",
            price: "490Р"
        },
        {

            image: "../Маркет/cap.png" ,
            title: "Бейсболка",
            price: "1990Р"
        },
        {

            image: "../Маркет/a5.png" ,
            title: "Вымпел (А5)",
            price: "690Р"
        }
        ]
    }
]
voucher.forEach((el,index) =>{
    block.insertAdjacentHTML('beforeend', `<p class="item">${voucher[index].country}</p>`)

    let items = document.querySelectorAll('.item')
    items[0].classList.add('select')
    ShowCard(0)
    items.forEach((el, index) => el.addEventListener('click', (e) => {
        items.forEach((el) => { 
            el.classList.remove('select')
        })
        el.classList.add('select')
        ShowCard(index)
    }))
})
function ShowCard(index) {
    inner.innerHTML = ''
        voucher[index].card.forEach((el) => {
            inner.insertAdjacentHTML('beforeend',`<div class="card">
            <img src = "${el.image}" alt"">
            <div class="title-card">${el.title}</div>
            <div class="price-card">Цена: ${el.price}</div>
            <button class="">Добавить в корзину</button>
            </div>`)
    })
}