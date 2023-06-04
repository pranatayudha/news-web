var getUrl = window.location;
var baseUrl =
  getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split("/")[1];

if (document.getElementById("articleDeleted")) {
  setTimeout(() => {
    var element = document.getElementById("articleDeleted");
    element.parentNode.removeChild(element);
  }, 3000);
} else if (document.getElementById("articleUpdated")) {
  setTimeout(() => {
    var element = document.getElementById("articleUpdated");
    element.parentNode.removeChild(element);
  }, 3000);
}

function incrementLike(id, lastLike) {
  document.getElementById("num-like-main-" + id).innerHTML =
    "<i class='fa fa-thumbs-o-up' aria-hidden='true'></i> " + (lastLike + 1);
  document
    .getElementById("num-like-main-" + id)
    .setAttribute("style", "pointer-events: none !important");

  if (document.getElementById("num-like-related-" + id)) {
    document.getElementById("num-like-related-" + id).innerHTML =
      "<i class='fa fa-thumbs-o-up' aria-hidden='true'></i> " + (lastLike + 1);
  }

  if (document.getElementById("num-like-mostview-" + id)) {
    document.getElementById("num-like-mostview-" + id).innerHTML =
      "<i class='fa fa-thumbs-o-up' aria-hidden='true'></i> " + (lastLike + 1);
  }

  $.ajax({
    type: "POST",
    url: baseUrl + "/client/increment_like/" + id,
    dataType: "json",
    success: function(resp) {
      console.log("good");
      $("#trend-article").html(resp.html);
    }
  });
}

$("#classynav>ul>li").click(function() {
  $("#tab-5").addClass("active");
});

$("#selectSearch").change(function() {
  if ($(this).val() == "newest") {
    $("#listArticleNewest").show() && $("#listArticleLatest").hide();
    if ($("#searchInput") != "") {
      filter_list_article_newest();
    }
  } else {
    $("#listArticleNewest").hide() && $("#listArticleLatest").show();
    if ($("#searchInput") != "") {
      filter_list_article_latest();
    }
  }
});

$("#selectMessages").change(function() {
  if ($(this).val() == "newest") {
    $("#listMessagesNewest").show() && $("#listMessagesLatest").hide();
    if ($("#searchMessage") != "") {
      filter_list_message_newest();
    }
  } else {
    $("#listMessagesNewest").hide() && $("#listMessagesLatest").show();
    if ($("#searchMessage") != "") {
      filter_list_message_latest();
    }
  }
});

function filter_list_article_newest() {
  var input, filter, div, li, strong;
  input = document.getElementById("searchInput");
  filter = input.value.toUpperCase();
  ul = document.getElementById("listArticleNewest");
  li = ul.getElementsByTagName("li");
  // ul.style.display="";

  for (i = 0; i < li.length; i++) {
    strong = li[i].getElementsByTagName("strong")[0];
    p = li[i].getElementsByTagName("p")[0];
    small = li[i].getElementsByTagName("small")[0];
    if (
      strong.innerHTML.toUpperCase().indexOf(filter) > -1 ||
      p.innerHTML.toUpperCase().indexOf(filter) > -1 ||
      small.innerHTML.toUpperCase().indexOf(filter) > -1
    ) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}

function filter_list_article_latest() {
  var input, filter, div, li, strong;
  input = document.getElementById("searchInput");
  filter = input.value.toUpperCase();
  ul = document.getElementById("listArticleLatest");
  li = ul.getElementsByTagName("li");

  for (i = 0; i < li.length; i++) {
    strong = li[i].getElementsByTagName("strong")[0];
    p = li[i].getElementsByTagName("p")[0];
    small = li[i].getElementsByTagName("small")[0];
    if (
      strong.innerHTML.toUpperCase().indexOf(filter) > -1 ||
      p.innerHTML.toUpperCase().indexOf(filter) > -1 ||
      small.innerHTML.toUpperCase().indexOf(filter) > -1
    ) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}

function filter_list_message_newest() {
  var input, filter, li, strong;
  input = document.getElementById("searchMessage");
  filter = input.value.toUpperCase();
  ul = document.getElementById("listMessagesNewest");
  li = ul.getElementsByTagName("li");

  for (i = 0; i < li.length; i++) {
    strong = li[i].getElementsByTagName("strong")[0];
    p = li[i].getElementsByTagName("p")[0];
    small = li[i].getElementsByTagName("small")[0];
    if (
      strong.innerHTML.toUpperCase().indexOf(filter) > -1 ||
      p.innerHTML.toUpperCase().indexOf(filter) > -1 ||
      small.innerHTML.toUpperCase().indexOf(filter) > -1
    ) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}

function filter_list_message_latest() {
  var input, filter, li, strong;
  input = document.getElementById("searchMessage");
  filter = input.value.toUpperCase();
  ul = document.getElementById("listMessagesLatest");
  li = ul.getElementsByTagName("li");

  for (i = 0; i < li.length; i++) {
    strong = li[i].getElementsByTagName("strong")[0];
    p = li[i].getElementsByTagName("p")[0];
    small = li[i].getElementsByTagName("small")[0];
    if (
      strong.innerHTML.toUpperCase().indexOf(filter) > -1 ||
      p.innerHTML.toUpperCase().indexOf(filter) > -1 ||
      small.innerHTML.toUpperCase().indexOf(filter) > -1
    ) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}
