let page4H1 = document.querySelectorAll(".collab-left-top h1");
let page4P = document.querySelectorAll(".collab-left-bottom p");
let page4IMG = document.querySelectorAll(".collab-wrapper img");
let page4Click = () => {
  page4H1.forEach((h1) => {
    h1.addEventListener("click", () => {
      page4H1.forEach((i) => {
        i.classList.remove("select");
      });
      h1.classList.add("select");

      let h1ID = h1.getAttribute("id");
      page4IMG.forEach((img) => {
        img.classList.add("hide");
      });
      page4P.forEach((p) => {
        p.classList.add("hide");
      });

      if (h1ID == "design-h1") {
        console.log(h1ID);
        console.log(page4P[0]);
        page4P[0].classList.remove("hide");
        page4IMG[0].classList.remove("hide");
      } else if (h1ID == "project-h1") {
        console.log(h1ID);
        console.log(page4P[1]);
        page4P[1].classList.remove("hide");
        page4IMG[1].classList.remove("hide");
      } else {
        console.log(h1ID);
        console.log(page4P[2]);
        page4P[2].classList.remove("hide");
        page4IMG[2].classList.remove("hide");
      }
    });
  });
};

page4Click();
