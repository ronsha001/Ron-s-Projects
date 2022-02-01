const icon = document.querySelector(".icon");
const search = document.querySelector(".search");
const clear = document.querySelector(".clear");
var mysearch = document.getElementById("mysearch");

icon.onclick = function () {
  search.classList.toggle("active");
  search_active = document.querySelector(".icon");
  if (mysearch.value > "") {
    this.closest("form").submit();
    mysearch.value = "";
    return false;
  }
};
clear.onclick = function () {
  mysearch.value = "";
  search.className = "search";
};
