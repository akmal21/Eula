const wrapper = document.querySelector(".sliderWrapper");
const menuItems = document.querySelectorAll(".menuItem");

const products = [
  {
    id: 1,
    title: "Plaid Cropped Hooded",
    price: 80,
    colors: [
      {
        code: "blue",
        img: "Product/Blue Plaid Cropped Hooded.webp",
      },
      {
        code: "pink",
        img: "Blue-Plaid-Cropped-Hooded-Shirt-Nayeon-Twice_head-5 (1)-Photoroom.png",
      },
    ],
  },
  {
    id: 2,
    title: "Sleeves Cardigan",
    price: 75,
    colors: [
      {
        code: "blue",
        img: "Product/Navy-Blue-Banded-Sleeves-Cardigan-Choi-Seung-Hyo-Love-Next-Door.webp",
      },
      {
        code: "white",
        img: "Product/white-Banded-Sleeves-Cardigan-Choi-Seung-Hyo-Love-Next-Doo.webp",
      },
    ],
  },
  {
    id: 3,
    title: "Floral Puff Sleeve Dresses",
    price: 49,
    colors: [
      {
        code: "white",
        img: "Product/4cc0b068a6b594a2904a315a815f8f07 (1).webp",
      },
      {
        code: "blue",
        img: "blue floral puff sleeve.jpg",
      },
    ],
  },
  {
    id: 4,
    title: "Floral  Maxi Dress",
    price: 100,
    colors: [
      {
        code: "blue",
        img: "Product/Blue colour.webp",
      },
      {
        code: "palevioletred",
        img: "Peony floral.webp",
      },
    ],
  },
  {
    id: 5,
    title: "Baby Sweater",
    price: 29,
    colors: [
      {
        code: "maroon",
        img: "Product/hmgoepprod (1).webp",
      },
      {
        code: "white",
        img: "hmgoepprod.webp",
      },
    ],
  },
];

let choosenProduct = products[0];

const currentProductImg = document.querySelector(".productImg");
const currentProductTitle = document.querySelector(".productTitle");
const currentProductPrice = document.querySelector(".productPrice");
const currentProductColors = document.querySelectorAll(".color");
const currentProductSizes = document.querySelectorAll(".size");

menuItems.forEach((item, index) => {
  item.addEventListener("click", () => {
    //change the current slide
    wrapper.style.transform = `translateX(${-100 * index}vw)`;

    //change the choosen product
    choosenProduct = products[index];

    //change texts of currentProduct
    currentProductTitle.textContent = choosenProduct.title;
    currentProductPrice.textContent = "RM" + choosenProduct.price;
    currentProductImg.src = choosenProduct.colors[0].img;

    //assing new colors
    currentProductColors.forEach((color, index) => {
      color.style.backgroundColor = choosenProduct.colors[index].code;
    });
  });
});

currentProductColors.forEach((color, index) => {
  color.addEventListener("click", () => {
    currentProductImg.src = choosenProduct.colors[index].img;
  });
});

currentProductSizes.forEach((size, index) => {
  size.addEventListener("click", () => {
    currentProductSizes.forEach((size) => {
      size.style.backgroundColor = "white";
      size.style.color = "black";
    });
    size.style.backgroundColor = "black";
    size.style.color = "white";
  });
});


const productButton = document.querySelector(".productButton");
const payment = document.querySelector(".payment");
const close = document.querySelector(".close");

productButton.addEventListener("click", () => {
  payment.style.display = "flex";
});

close.addEventListener("click", () => {
  payment.style.display = "none";
});