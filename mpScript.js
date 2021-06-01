//TEXTAREA MAXLENGTH EVENT

$("#chatText").on('paste', function(e) {
    if ($("#chatTextInput").val().length + e.originalEvent.clipboardData.getData('text').length >= 140) {
        e.preventDefault();
    }
});

//AJAX TO SUGGEST / AUTOCOMPLETE SEARCH

$("#searchForm").keyup(function(e) {
    var form = $(this),
        text = form.find("input[name='receiver']").val();
<<<<<<< HEAD
    var pending = $.post("./mpServerAJAX.php", { "search": text });
=======
    var pending = $.post("http://localhost:8888/Web@cademie/Tweet_Academie/mpServerAJAX.php", { "search": text });
>>>>>>> a879e10aaaef77f2f805d4d90a68d78c37cc604f
    pending.done(function(data) {
        $(".autocomplete-items").html(data);
        $(".searchResults").click(function() {
            $("#searchBar").val(this.innerHTML);
            $(".autocomplete-items").html("");
        })
    })
})

//REDIRECT TO CHATROOM WITH USER AND TARGET

$(".chatBox").click(function() {
<<<<<<< HEAD
    var href = "./mpServerChatroom.php?receiver=" + $(this).find(".username")[0].innerHTML;
=======
    var href = "http://localhost:8888/Web@cademie/Tweet_Academie/mpServerChatroom.php?receiver=" + $(this).find(".username")[0].innerHTML;
>>>>>>> a879e10aaaef77f2f805d4d90a68d78c37cc604f
    window.location = href;
})

//SEND NEW MESSAGE

$("#chatText").submit((e) => {
    e.preventDefault();
    if ($("#chatTextInput").val() != "") {
        var mail = $.post("mpServerAJAX.php", { "msg": $("#chatTextInput").val(), "receiver_name": $(".username")[0].innerHTML });
        mail.done((data) => {
            $(".chatroom").html(data);
            $("#chatTextInput").val("");
        })
    }
})