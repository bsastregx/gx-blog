/*******************************
DETECT MOBILE DEVICES
*******************************/
window.mobileCheck = function () {
  let check = false;
  (function (a) {
    if (
      /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(
        a
      ) ||
      /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(
        a.substr(0, 4)
      )
    )
      check = true;
  })(navigator.userAgent || navigator.vendor || window.opera);
  return check;
};
const mobileDevice = window.mobileCheck();
if (mobileDevice) {
  document.body.classList.add("mobile");
}

/*******************************
  ON DOCUMENT READY
  *******************************/
(function () {
  // your page initialization code here
  // the DOM will be available here
  document.body.classList.remove("body-hidden");
})();

/*******************************
  VIEWPORT WIDTH
*******************************/
const vw = Math.max(
  document.documentElement.clientWidth || 0,
  window.innerWidth || 0
);

/*******************************
  NAVBAR BURGER
  *******************************/
class NavbarBurguer {
  // 1.Describe and create/initiate our object
  constructor(navbarId, menuId, burgerId) {
    // Initialize All Required DOM Element
    this.navbar = document.getElementById(navbarId);
    this.burgerMenu = document.getElementById(burgerId);
    this.navbarMenu = document.getElementById(menuId);
    this.events();
  }

  // 2.Events
  events() {
    this.burgerMenu.addEventListener("click", this.toggle.bind(this));
  }

  //3.Methods
  toggle() {
    this.navbar.classList.toggle("navbar--active");
    this.burgerMenu.classList.toggle("active");
    this.navbarMenu.classList.toggle("active");

    if (this.navbarMenu.classList.contains("active")) {
      this.navbar.classList.add("navbar--white");
      this.navbar.classList.add("z-index-15");
      this.navbarMenu.style.maxHeight = this.navbarMenu.scrollHeight + "px";
    } else {
      this.navbarMenu.removeAttribute("style");
      setTimeout(() => {
        this.navbar.classList.remove("navbar--white");
        this.navbar.classList.remove("z-index-15");
      }, 250);
    }
  }
}
const mainNavbarBurguer = new NavbarBurguer(
  "main-navbar",
  "menu-main",
  "burger-main"
);

/*******************************
  TOPBAR TEXT
  *******************************/
//If the user comes from Genexus.com, display "Back to genexus.com"
let referrer = document.referrer;
const topBarText = document.querySelector("#top-bar .top-bar__text");

if (referrer) {
  if (referrer.includes("www.genexus.com")) {
    sessionStorage.setItem("userCameFromGenexus", true);
    topBarText.innerHTML = "Back to GeneXus.com";
  } else {
    if (sessionStorage.getItem("userCameFromGenexus")) {
      topBarText.innerHTML = "Back to GeneXus.com";
    }
  }
}

/*******************************
MENU ITEMS RESPONSIVE (MAIN NAV)
*******************************/
if (vw <= 767 || mobileDevice) {
  const mainNav = document.getElementById("main-navbar");
  const menuItems = mainNav.querySelectorAll(".menu-item");
  const mainNavMenu = document.getElementById("menu-main");
  menuItems.forEach((menuItem) => {
    const menuItemLink = menuItem.querySelector(".menu-item__link");
    if (menuItemLink) {
      //set item initial max-height
      menuItem.style.maxHeight = menuItemLink.offsetHeight + "px";

      menuItemLink.addEventListener("click", () => {
        menuItemLink.classList.toggle("menu-item__link--uncollapsed");
        let cardContentHeight = null;
        if (menuItemLink.classList.contains("menu-item__link--uncollapsed")) {
          const card = menuItemLink.nextElementSibling;
          cardContentHeight = card.offsetHeight;
          menuItem.style.maxHeight =
            menuItemLink.offsetHeight + cardContentHeight + "px";
        } else {
          menuItem.style.maxHeight = menuItemLink.offsetHeight + "px";
        }

        //update menu max-height
        mainNavMenuHeigt = mainNavMenu.offsetHeight + cardContentHeight;
        console.log(mainNavMenuHeigt);
        mainNavMenu.style.maxHeight = mainNavMenuHeigt + "px";
      });
    }
  });
}

/********************************************
FLICKITY SLIDER (CATEGORIES SHOWCASE IN HOME)
********************************************/

if (mobileDevice) {
  const mainCarousel = document.querySelector(".main-carousel");
  if (mainCarousel) {
    var flktyCategories = new Flickity(mainCarousel, {
      cellAlign: "left",
      contain: true,
      groupCells: true,
      prevNextButtons: false,
      pageDots: false,
    });
  }
}

/********************************************
FLICKITY SLIDER (PAGINATION)
********************************************/
const paginationWithSlider = document.querySelector(".pagination--with-slider");
let flktyPagination = null;
if (paginationWithSlider) {
  flktyPagination = new Flickity(paginationWithSlider, {
    cellAlign: "left",
    contain: true,
    groupCells: true,
    prevNextButtons: true,
    pageDots: false,
  });
}
//If is traditional pagination (only on search.php) go to actual cell
if (
  paginationWithSlider &&
  paginationWithSlider.classList.contains("pagination--traditional")
) {
  const activePagNumber = parseInt(
    paginationWithSlider.querySelector(".pagination__pag--active").innerHTML
  );
  //go to actual cell
  flktyPagination.selectCell(activePagNumber - 1, false, true);
}

/******************************************
  REPOSITION WP-ULIKE POSITION (SINGLE.PHP)
******************************************/
(function () {
  // your page initialization code here
  // the DOM will be available here
  if (document.body.classList.contains("single-post")) {
    //REPOSITION .the-content .wpulike
    const postWpulike = document.querySelector(".the-content > .wpulike");
    const postInfo = document.querySelector(
      ".post-info-social-container .post-info"
    );
    if (postWpulike && postInfo) {
      postInfo.prepend(postWpulike);
    }

    //REPOSITION .commentlist .wpulike
    const commentList = document.querySelector(".commentlist");
    if (commentList) {
      const wpulikes = commentList.querySelectorAll(".wpulike");
      if (wpulikes.length > 0) {
        wpulikes.forEach((wplike) => {
          const wpLikeParent = wplike.parentElement;
          const replyDiv = wpLikeParent.nextElementSibling;
          if (replyDiv) {
            replyDiv.append(wplike);
          }
        });
      }
    }
  }
})();

/**************************
  REPOSITION SHARE BUTTONS
**************************/
(function () {
  // your page initialization code here
  // the DOM will be available here
  const shareDaddy = document.querySelector(".sharedaddy");
  if (shareDaddy) {
    const postInfoSocialContainer = document.querySelector(
      ".post-info-social-container"
    );
    if (postInfoSocialContainer) {
      postInfoSocialContainer.prepend(shareDaddy);
    }
  }
})();

/*******************************************
BACK TO TOP BUTTON
********************************************/
const backToTopButtons = document.querySelectorAll(
  ".back-to-top, .back-to-top__text"
);
backToTopButtons.forEach((button) => {
  button.addEventListener("click", function () {
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  });
});

const backtToTopDesktop = document.querySelector(".back-to-top-container");

window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
    // you're at the bottom of the page
    // show desktop "Back to top" button
    backtToTopDesktop.classList.remove("back-to-top-container--hidden");
  } else {
    // hide desktop "Back to top" button
    backtToTopDesktop.classList.add("back-to-top-container--hidden");
  }
}

/*****************************************************
CLEAR SEARCH INPUT ON TRADITIONAL SEARCH (SEARCH.PHP)
*****************************************************/
if (document.body.classList.contains("search")) {
  console.log("search page");
  const clearButton = document.querySelector(
    "body.search .search-wrapper .fa-times"
  );
  const inputSearch = document.querySelector(
    "body.search .search-wrapper .input-search"
  );
  if (clearButton) {
    clearButton.addEventListener("click", function () {
      inputSearch.value = "";
      this.classList.add("hidden");
    });
  }
  if (inputSearch) {
    inputSearch.addEventListener("input", function () {
      if (this.value === "") {
        //empty input
        clearButton.classList.add("hidden");
      } else {
        clearButton.classList.remove("hidden");
      }
    });
  }
}
