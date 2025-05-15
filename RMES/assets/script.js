/* Présentation visuelle dans la console. Utilité : 0 mais c'est stylé :) */

function init() {
  console.log(
    "%cRMES - School without frontieres",
    "font-size: 50px; font-weight: bold; color: red; text-shadow: 2px 2px 4px black;text-align: center;"
  );
  console.log(
    "%cProjet Open Source : https://github.com/NoePoirier5327/RMES",
    "font-size: 15px; font-weight: bold; color: darkgray; text-shadow: 2px 2px 4px black;text-align: center;"
  );
  console.log(
    "%c⚠️ Attention : Ne collez pas de code ici qui provient d’une source inconnue.\nCela peut vous exposer à des attaques (comme le vol de données ou l'exécution de code malveillant).",
    "font-size: 10px; font-weight: italic; color: gray; text-shadow: 2px 2px 4px black;"
  );
  console.log(
    "%cConsole du développeur : ",
    "font-size: 15px; font-weight: bold; color: green; text-shadow: 2px 2px 4px black;text-align: center;"
  );
}
init();

/* Load schools */

fetch("api/config/schools").then(res => res.json()).then(res => {
  if(res.status == 200){
    let wrapper = document.querySelector(".slider-ecoles .swiper-wrapper");

    res.data.forEach(school => {
      let slide = document.createElement("div");
      slide.className = "swiper-slide";

      let link = document.createElement("a");
      link.classList.add("school_logo");
      link.href = school.website;
      link.target = "_blank";

      let image = document.createElement("img");
      image.src = school.image;
      image.alt = school.name;

      let button = document.createElement("button");
      button.innerHTML = `<i class="fa-solid fa-location-dot fa-xl"></i> Show on map`;
      button.className = "map"

      button.addEventListener("click", () => {
        new WinBox(`Map - ${school.name}`, {
            url: school.map,
            x: "center",
            y: "center"
        }).setBackground("aquablue")
      })
      
      link.appendChild(image);
      slide.appendChild(link);
      slide.appendChild(button);
      wrapper.appendChild(slide)
    })


    /* SLIDER */

    var sliderEcoles = new Swiper(".slider-ecoles", {
      slidesPerView: 1,
      spaceBetween: 10,
      loop: true,
      speed: 3000,
      autoplay: {
        delay: -1,
        disableOnInteraction: false,
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 4,
          spaceBetween: 40,
        },
        1024: {
          slidesPerView: 5,
          spaceBetween: 50,
        },
      },
    });
  }
})

/* Load developers */

fetch("api/config/developers").then(res => res.json()).then(res => {
  if(res.status == 200){
    let wrapper = document.querySelector(".slider-devs .swiper-wrapper")
    res.data.forEach(developer => {
      let slide = document.createElement("div");
      slide.className = "swiper-slide";

      let image = document.createElement("img");
      image.src = developer.picture;
      image.alt = developer.name;
      image.className = "avatar"

      let text = document.createElement("div");
      text.className = "text";

      let name = document.createElement("div");
      name.className = "name";
      name.innerText = developer.name;

      let job = document.createElement("div");
      job.className = "job";
      job.innerText = developer.job;

      let link = document.createElement("a");
      link.href = developer.website;
      link.target = "_blank";
      link.innerHTML = `Open website <i class="fa-solid fa-arrow-up-right-from-square"></i>`;

      slide.appendChild(image);

      text.appendChild(name)
      text.appendChild(job)
      text.appendChild(link)
      slide.appendChild(text);
      wrapper.appendChild(slide)
    })

    /* SLIDER */

    var sliderDevs = new Swiper(".slider-devs", {
      slidesPerView: "auto",
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      grabCursor: true,
    });
  }
})
