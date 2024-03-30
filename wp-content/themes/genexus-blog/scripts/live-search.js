/*******************************
LIVE SEARCH
*******************************/
class LiveSearch {
  // 1.CREATE/INITIATE THE OBJECT
  constructor() {
    this.menuItemLiveSearch = document.querySelector(".menu-item--live-search");
    this.inputLiveSearch = document.getElementById("input-live-search");
    this.feedback = document.querySelector(".search-results-feedback");
    this.wrapper = document.querySelector(".search-results-wrapper");
    this.clearInputIcon = this.menuItemLiveSearch.querySelector(".fa-times");
    this.previousValue;
    this.isSpinnerVisible = false;
    this.category = this.inputLiveSearch.dataset.cat;
    this.author = this.inputLiveSearch.dataset.author;
    this.tag = this.inputLiveSearch.dataset.tag;
    this.paged;
    this.requestComesFromPagination = false;
    this.spinner =
      '<div class="spinner-container"><div id="loading-indicator" style="width: 35px; height: 35px;" role="progressbar" class="MuiCircularProgress-root MuiCircularProgress-colorPrimary MuiCircularProgress-indeterminate"><svg viewBox="22 22 44 44" class="MuiCircularProgress-svg"> <circle cx="44" cy="44" r="20.2" fill="none" stroke-width="3.6" class="MuiCircularProgress-circle MuiCircularProgress-circleIndeterminate"></circle></svg></div><span class="spinner-container__text">Getting posts...</span></div>';
    this.flickityPagination = null;
    this.flickityPaginationActivePag = null;

    //Call events
    this.setWrapperMinHeight();
    this.events();
    this.resizeObserver();
  }

  //2.EVENTS
  events() {
    this.inputLiveSearch.addEventListener("keyup", this.typingLogic.bind(this));
    this.clearInputIcon.addEventListener("click", this.clearInput.bind(this));
  }

  //3.RESIZE OBSERVER
  resizeObserver() {
    let resizer = new ResizeObserver(this.handleResize.bind(this));
    resizer.observe(this.wrapper);
  }
  handleResize() {
    this.setWrapperMinHeight();
  }
  setWrapperMinHeight() {
    const grid = this.wrapper.querySelector(".grid");
    if (grid !== null) {
      const gridHeight =
        this.wrapper.querySelector(".grid").offsetHeight + "px";
      this.wrapper.style.minHeight = gridHeight;
    }
  }

  typingLogic() {
    if (
      this.inputLiveSearch.value !== this.previousValue ||
      this.requestComesFromPagination
    ) {
      this.hideWrapper();
      setTimeout(this.showFeedback.bind(this), 250);

      //console.log(this.requestComesFromPagination);
      if (!this.requestComesFromPagination) {
        this.paged = 1;
      }

      clearTimeout(this.typingTimer);
      if (this.inputLiveSearch.value) {
        this.menuItemLiveSearch.classList.add("menu-item--has-content");

        if (!this.isSpinnerVisible) {
          this.feedback.innerHTML = this.spinner;
          this.isSpinnerVisible = true;
        }
        this.typingTimer = setTimeout(this.getResults.bind(this), 1000);
      } else {
        this.menuItemLiveSearch.classList.remove("menu-item--has-content");
        this.feedback.innerHTML = this.spinner;
        this.isSpinnerVisible = true;
        this.getResults();
      }

      this.previousValue = this.inputLiveSearch.value;
      this.requestComesFromPagination = false;
    }
  }

  getLangCode() {
    const htmlLang = document.documentElement.lang;
    switch (htmlLang) {
      case "en-US":
        return "en";
      case "pt-br":
        return "pt-br";
      case "es-ES":
        return "es";
      default:
        return "en";
    }
  }

  getResults() {
    const langCode = this.getLangCode();
    const value = this.inputLiveSearch.value;
    fetch(
      "/wp-json/genexus/v1/posts?search=" +
        value +
        "&per_page=9&paged=" +
        this.paged +
        "&cat=" +
        this.category +
        "&tag=" +
        this.tag +
        "&author=" +
        this.author +
        "&lang_code=" +
        langCode,
      {
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
      }
    )
      .then((response) => response.json())
      .then((data) => {
        console.log("data", data);
        this.isSpinnerVisible = false;
        const posts = data.posts;

        if (posts.length > 0) {
          //Create the grid and columns
          const grid = document.createElement("div");
          grid.classList.add("grid", "grid-3");
          const col1 = document.createElement("div");
          col1.classList.add("grid__item");
          if (posts.length === 1)
            col1.classList.add("grid__item--last-with-post");
          const col2 = document.createElement("div");
          col2.classList.add("grid__item");
          if (posts.length === 3)
            col2.classList.add("grid__item--last-with-post");
          const col3 = document.createElement("div");
          col3.classList.add("grid__item");

          //Append the posts to the columns
          posts.forEach((post, i) => {
            //datos
            const postCategories = post.categories;
            const postTags = post.tags;

            //elementos
            //article
            const article = document.createElement("article");
            article.classList.add("post");

            const categoriesContainer = document.createElement("div");
            categoriesContainer.classList.add("categories-tags-container");
            //categories (We only want to display one category per post)
            const firstCategory = postCategories.slice(0, 1);
            firstCategory.forEach((cat) => {
              const catEl = document.createElement("a");
              catEl.classList.add("category-tag");
              catEl.setAttribute("href", cat.link);
              catEl.style.color = cat.color;
              catEl.style.backgroundColor = cat.bgcolor;
              catEl.innerText = cat.name;
              categoriesContainer.appendChild(catEl);
            });
            article.appendChild(categoriesContainer);

            //autor y fecha
            const authorEl = document.createElement("div");
            authorEl.classList.add("blog-author");

            const authorImageEL = document.createElement("span");
            authorImageEL.classList.add("blog-author__image");

            const authorImageUrl = document.createElement("a");
            authorImageUrl.setAttribute("href", post.author_url);

            const authorGravatarImg = document.createElement("img");
            authorGravatarImg.setAttribute("src", post.author_gravatar_url);

            authorImageUrl.appendChild(authorGravatarImg);
            authorImageEL.appendChild(authorImageUrl);
            authorEl.appendChild(authorImageEL);

            const authorNameUrl = document.createElement("a");
            authorNameUrl.setAttribute("href", post.author_url);
            const authorNameEl = document.createElement("span");
            authorNameEl.classList.add("blog-author__name");
            authorNameUrl.innerText = post.author_display_name;
            authorNameEl.appendChild(authorNameUrl);
            authorEl.appendChild(authorNameEl);

            const pipeEl = document.createElement("span");
            pipeEl.classList.add("blog-author__pipe");
            pipeEl.innerText = "|";
            authorEl.appendChild(pipeEl);

            const postDateEl = document.createElement("time");
            postDateEl.classList.add("blog-author__post-date");
            postDateEl.setAttribute("datetime", post.date);
            postDateEl.innerText = post.date;
            authorEl.appendChild(postDateEl);

            article.appendChild(authorEl);

            //titulo
            const titleEl = document.createElement("h1");
            titleEl.classList.add("post__title");
            const titleUrlEl = document.createElement("a");
            titleUrlEl.setAttribute("href", post.permalink);
            titleUrlEl.innerText = post.title;

            titleEl.appendChild(titleUrlEl);
            article.appendChild(titleEl);

            //featured image
            if (post.featured_img_url) {
              const imageContainerEl = document.createElement("div");
              imageContainerEl.classList.add("post__image");
              const imageUrlEl = document.createElement("a");
              imageUrlEl.setAttribute("href", post.permalink);
              const imageEl = document.createElement("img");
              imageEl.setAttribute("src", post.featured_img_url);

              imageUrlEl.appendChild(imageEl);
              imageContainerEl.appendChild(imageUrlEl);
              article.appendChild(imageContainerEl);
            }

            //Excerpt (Yoast meta description)
            if (post.yoast_meta_description_short) {
              const excerptEl = document.createElement("p");
              excerptEl.classList.add("post__excerpt");
              excerptEl.innerText = post.yoast_meta_description_short;

              article.appendChild(excerptEl);
            }

            //tags
            if (post.tags) {
              const tagsContainerEl = document.createElement("p");
              tagsContainerEl.classList.add("tags-container");

              //(We only want to display a maximum of three tags per post)
              const threeTags = postTags.slice(0, 3);

              threeTags.forEach((tag) => {
                const tagEl = document.createElement("a");
                tagEl.classList.add("tag");
                tagEl.setAttribute("href", tag.link);
                tagEl.innerText = tag.name;
                tagsContainerEl.appendChild(tagEl);
              });

              article.appendChild(tagsContainerEl);
            }

            //separator
            const separator = document.createElement("hr");
            separator.classList.add("post-separator");

            if (i === 0 || i % 3 == 0) {
              col1.appendChild(article);
              col1.appendChild(separator);
            } else if (i == 1 || (i - 1) % 3 == 0) {
              col2.appendChild(article);
              col2.appendChild(separator);
            } else if ((i + 1) % 3 == 0) {
              col3.appendChild(article);
              col3.appendChild(separator);
            }
          });

          //append columns to grid
          grid.appendChild(col1);
          grid.appendChild(col2);
          grid.appendChild(col3);

          this.wrapper.innerHTML = "";
          this.wrapper.appendChild(grid);
          setTimeout(this.showWrapper.bind(this), 250);

          if (data.pagination[0]) {
            this.wrapper.appendChild(this.pagination(data.pagination));
            this.paginationLogic();
            if (data.pagination[0].length > 5) {
              this.paginationSlider();
            }
          }
        } else {
          this.feedback.innerHTML = "No results matched your query.";
        }

        this.setWrapperMinHeight();
      });
  }

  pagination(pagination) {
    const paginationEl = document.createElement("ul");
    paginationEl.classList.add("pagination");
    if (pagination[0].length > 5) {
      //if pagination is greater than 5, use slider
      paginationEl.classList.add("pagination--with-slider");
    }
    let index = 1;

    pagination[0].forEach((pag) => {
      const pagLiEl = document.createElement("li");
      const currentPage = pag.indexOf("current");

      if (pagination[0].length > 5) {
        pagLiEl.classList.add("carousel-cell");
        const pagSpanEl = document.createElement("span");
        pagSpanEl.classList.add("pagination__pag");
        if (currentPage !== -1) {
          pagSpanEl.classList.add("pagination__pag--active");
          this.flickityPaginationActivePag = index;
        }
        pagSpanEl.innerHTML = index;
        pagLiEl.appendChild(pagSpanEl);
      } else {
        pagLiEl.classList.add("pagination__pag");
        if (currentPage !== -1) {
          pagLiEl.classList.add("pagination__pag--active");
        }
        pagLiEl.innerHTML = index;
      }
      paginationEl.appendChild(pagLiEl);
      index++;
    });

    return paginationEl;
  }

  paginationLogic() {
    const paginationPags = document.querySelectorAll(
      ".pagination .pagination__pag"
    );
    paginationPags.forEach((pag) => {
      const pagNumber = pag.innerHTML;
      pag.addEventListener("click", () => {
        const liveSearchPosition = document
          .getElementById("input-live-search")
          .getBoundingClientRect().top;
        let scrollTo;
        if (liveSearchPosition < 0) {
          scrollTo = window.pageYOffset - Math.abs(liveSearchPosition) - 50;
        } else {
          scrollTo = window.pageYOffset + liveSearchPosition - 50;
        }
        window.scroll({
          top: scrollTo,
          behavior: "smooth",
        });
        setTimeout(() => {
          this.requestComesFromPagination = true;
          this.paged = pagNumber;
          this.typingLogic();
        }, 500);
      });
    });
  }

  paginationSlider() {
    if (this.flickityPagination) {
      //destroy previous flickity instance
      this.flickityPagination.destroy();
    }
    this.flickityPagination = new Flickity(".pagination--with-slider", {
      cellAlign: "left",
      contain: true,
      groupCells: true,
      prevNextButtons: true,
      pageDots: false,
    });

    //go to actual cell
    this.flickityPagination.selectCell(
      this.flickityPaginationActivePag - 1,
      false,
      true
    );
  }

  hideWrapper() {
    this.wrapper.classList.add("search-results-wrapper--hidden");
  }
  showWrapper() {
    this.wrapper.classList.remove("search-results-wrapper--hidden");
    this.hideFeedback();
  }

  hideFeedback() {
    this.feedback.classList.add("search-results-feedback--hidden");
  }
  showFeedback() {
    this.feedback.classList.remove("search-results-feedback--hidden");
  }
  clearInput() {
    this.inputLiveSearch.value = "";
    this.typingLogic();
  }
}

let liveSearch;
const liveSearchInput = document.getElementById("input-live-search");
if (liveSearchInput) {
  liveSearch = new LiveSearch();
}
