//TEXTAREA MAXLENGTH EVENT

$("#tweetForm").on('paste', function(e) {
    if ($("#tweetFormText").val().length + e.originalEvent.clipboardData.getData('text').length >= 140) {
        e.preventDefault();
    }
});

//DISABLE BUTTON IF THERE'S NO TEXT 

if ($.trim($("#tweetFormText").val()).length == 0) {
    $("#tweetFormButton").prop("disabled", true);
} else {
    $("#tweetFormButton").prop("disabled", false);
}

//USERNAME SUGGESTIONS WHEN TYPING TWEET

$("#tweetForm").keyup(function() {
    if ($.trim($("#tweetFormText").val()).length == 0) {
        $("#tweetFormButton").prop("disabled", true);
    } else {
        $("#tweetFormButton").prop("disabled", false);
    }
    var form = $(this),
        text = form.find("textarea").val(),
        textTab = text.split(" ");
    if (textTab[textTab.length - 1].search("@") === 0) {
        textTab[textTab.length - 1] = textTab[textTab.length - 1].substr(1);
<<<<<<< HEAD
        var pending = $.post("./tweetServerAJAX.php", { "search": textTab[textTab.length - 1] });
=======
        var pending = $.post("http://localhost:8888/Web@cademie/Tweet_Academie/tweetServerAJAX.php", { "search": textTab[textTab.length - 1] });
>>>>>>> a879e10aaaef77f2f805d4d90a68d78c37cc604f
        pending.done(function(data) {
            form.find(".autocomplete-items").html(data);
            form.find(".searchResults").click(function() {
                textTab[textTab.length - 1] = this.innerHTML;
                text = textTab.join(" ");
                form.find("textarea").val(text);
                form.find(".autocomplete-items").html("");
            })
        })
    }
})

//READ FILE NAME WHEN UPLOADED / DELETE THE FILE / INPUT THE PATH INTO TWEET
var formData = new FormData();
var imgNames = [];

$("#tweetFormImgUpload").change(function(e) {
    formData = new FormData();
    imgNames = [];
    if ($("#tweetFormImgUpload").prop("files")[0].type == "image/png") {
        for (let i = 0; i < $("#tweetFormImgUpload").prop("files").length; i++) {
            var file = $("#tweetFormImgUpload").prop("files")[i];
            var blob = file.slice(0, file.size, 'image/png');
            var fileRndName = getrandom() + ".png";
            imgNames.push("img/" + fileRndName);
            var tab = $("#tweetFormText").val().split(" ");
            tab.unshift(imgNames.join(" "));
            var newFile = new File([blob], fileRndName, { type: 'image/png' });
            formData.append('file' + i, newFile, fileRndName);
        }
        $("#tweetFormText").val(tab.join(" "));
    } else {
        formData = new FormData();
    }
})

$(".tweetForm").keypress((e) => {
    var tab = $("#tweetFormText").val().split(" ");
    for (let i = 0; i < imgNames.length; i++) {
        tab[i] = imgNames[i];
    }
    $("#tweetFormText").val(tab.join(" "));
})

//CREATE RANDOM STRING FOR IMAGE UPLOAD

function getrandom() {
    var random_string = Math.random().toString(32).substring(2, 5) + Math.random().toString(32).substring(2, 5);
    return random_string;
}
//AJAX TO ADD NEW TWEET ON MAIN FEED

$("#tweetForm").submit(function(e) {
    e.preventDefault();
    formData.append("tweet", $("#tweetFormText").val());
    $.ajax({
        method: 'POST',
<<<<<<< HEAD
        url: './tweetServerAJAX.php',
=======
        url: 'http://localhost:8888/Web@cademie/Tweet_Academie/tweetServerAJAX.php',
>>>>>>> a879e10aaaef77f2f805d4d90a68d78c37cc604f
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            $(".mainFeed").html(data);
            addOverlay();
            addRetweet();
        }
    });
})

//AJAX TO SUGGEST / AUTOCOMPLETE SEARCH

$("#searchForm").keyup(function(e) {
    var form = $(this),
        text = form.find("input[name='search']").val();
<<<<<<< HEAD
    var pending = $.post("./tweetServerAJAX.php", { "search": text });
=======
    var pending = $.post("http://localhost:8888/Web@cademie/Tweet_Academie/tweetServerAJAX.php", { "search": text });
>>>>>>> a879e10aaaef77f2f805d4d90a68d78c37cc604f
    pending.done(function(data) {
        form.find(".autocomplete-items").html(data);
        form.find(".searchResults").click(function() {
            form.find("#searchBar").val(this.innerHTML);
            form.find(".autocomplete-items").html("");
        })
    })
})


//AJAX REQUEST FOR MORE TWEETS ON BOTTOM SCROLL

var limit = 30;
$(window).scroll(function(e) {
    if (scrollY + $(window).height() > $(document).height() - 300) {
        limit += 10;
<<<<<<< HEAD
        if (window.location.pathname == "/profileServer.php") {
            var pending = $.post("./tweetServerAJAX.php", { "limit": limit, "scroll": true, "profile": $(".username").html() });
            pending.done(function(data) {
                $(".mainFeed").html(data);
                addOverlay();
                addRetweet();
            })
        } else {
            var pending = $.post("./tweetServerAJAX.php", { "limit": limit, "scroll": true });
            pending.done(function(data) {
                $(".mainFeed").html(data);
                addOverlay();
                addRetweet();
            })
        }
=======
        var pending = $.post("http://localhost:8888/Web@cademie/Tweet_Academie/tweetServerAJAX.php", { "limit": limit, "scroll": true });
        pending.done(function(data) {
            $(".mainFeed").html(data);
            addOverlay();
            addRetweet();
        })
>>>>>>> a879e10aaaef77f2f805d4d90a68d78c37cc604f
    }
})

//OVERLAY ON COMMENT 

//TOGGLE OFF OVERLAY ON CLICK
$(".overlay").click(function(e) {
    if (e.target == $(".overlay")[0]) {
        $('.overlay').toggle();
    }
})

//METHOD TO ADD OVERLAY WITH COMMENT SECTION
function addOverlay() {
    $(".tweetRespond").click(function() {
        $('.overlay').toggle();
        var section = $(this).parent().parent();
        $("#overlayTweetSection").html(section.html());
        var tweetId = $("#overlayTweetSection").find(".tweetId")[0].innerHTML;
<<<<<<< HEAD
        var comments = $.post("./tweetServerAJAX.php", { "tweet_id0": tweetId });
=======
        var comments = $.post("http://localhost:8888/Web@cademie/Tweet_Academie/tweetServerAJAX.php", { "tweet_id0": tweetId });
>>>>>>> a879e10aaaef77f2f805d4d90a68d78c37cc604f
        comments.done(function(data) {
            $("#overlayCommentSection").html(data);
        })
    })
}

addOverlay();

//AJAX TO ADD COMMENT
$("#commentSection").submit(function(e) {
    e.preventDefault();
    var text = $(this).find("textarea").val();
    $(this).find("textarea").val("");
    var tweetId = $("#overlayTweetSection").find(".tweetId")[0].innerHTML;
<<<<<<< HEAD
    var comments = $.post("./tweetServerAJAX.php", { "tweet_id1": tweetId, "comment": text });
=======
    var comments = $.post("http://localhost:8888/Web@cademie/Tweet_Academie/tweetServerAJAX.php", { "tweet_id1": tweetId, "comment": text });
>>>>>>> a879e10aaaef77f2f805d4d90a68d78c37cc604f
    comments.done(function(data) {
        $("#overlayCommentSection").html(data);
    })
})

//AJAX TO RETWEET TO YOUR OWN ACCOUNT 

addRetweet();

function addRetweet() {
    $(".tweetRetweet").click(function() {
        if (confirm("Retweet?")) {
            var tweetId = $(this).parent().parent().find(".tweetId").html();
<<<<<<< HEAD
            $.post("./tweetServerAJAX.php", { "retweetId": tweetId });
=======
            $.post("http://localhost:8888/Web@cademie/Tweet_Academie/tweetServerAJAX.php", { "retweetId": tweetId }).done(function(data) {
                console.log(data);
            });
>>>>>>> a879e10aaaef77f2f805d4d90a68d78c37cc604f
        }
    })
}

//AJAX TO FOLLOW AND UNFOLLOW AN ACCOUNT

$("#followButton").click(function() {
    var username = $(".username").html();
    if ($("#followButton").html() == "Follow") {
<<<<<<< HEAD
        $.post("./tweetServerAJAX.php", { "followUser": username }).done(function(data) {
=======
        $.post("http://localhost:8888/Web@cademie/Tweet_Academie/tweetServerAJAX.php", { "followUser": username }).done(function(data) {
            console.log(data);
>>>>>>> a879e10aaaef77f2f805d4d90a68d78c37cc604f
            $("#followButton").html("Unfollow");
        })
    }
    if ($("#followButton").html() == "Unfollow") {
<<<<<<< HEAD
        $.post("./tweetServerAJAX.php", { "unfollowUser": username }).done(function(data) {
=======
        $.post("http://localhost:8888/Web@cademie/Tweet_Academie/tweetServerAJAX.php", { "unfollowUser": username }).done(function(data) {
            console.log(data);
>>>>>>> a879e10aaaef77f2f805d4d90a68d78c37cc604f
            $("#followButton").html("Follow");
        })
    }
})