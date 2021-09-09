// +------------------------------------------------------------------------+
// | @author        : Michael Arawole (HENT Technologies)
// | @author_url    : https://logad.net
// | @author_email  : henttech@gmail.com
// +------------------------------------------------------------------------+
// | Copyright (c) 2020 HENT Technologies. All rights reserved.
// +------------------------------------------------------------------------+

// +----------------------------+
// | Custom Javascript
// +----------------------------+

function ajax_request(url, data, form = true) {
    if(form == false){
        var send = $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: "json",
            cache: false,
            error: function (xhr) {
                if (xhr.status == 404 || xhr.status == 500) {
                    alert("An unexpected error seems to have occurred. Now that we know, we're working to fix it ☺. ERROR : "+xhr.status);
                }
            },
        });
    }
    if(form == true){
        var send = $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            error: function (xhr) {
                if (xhr.status == 404 || xhr.status == 500) {
                    alert("An unexpected error seems to have occurred. Now that we know, we're working to fix it ☺. ERROR : "+xhr.status);
                }
            },
        });
    }
    return send;
}


// Load Content into modal
function modal_load(url, data, buttons = null){
    modal = $("#ModalFullscreen");
    modal_body = $('#modal-ajax-content');
    modal_label = $("#ModalFullscreenLabel");
    modal_footer = $("#ModalFullscreen .modal-footer");
    btns = buttons + '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';

    // Assign the modal footer first
    modal_footer.html(btns);
    
    $("#ModalFullscreen .modal-body").addClass('running');
    modal.modal('show');
    var req = ajax_request(url, data, false);
    req.done(function(data){
        if(data.code == 200){
            alert(data.msg);
            modal_body.html(data.html);
            modal_label.html(data.title);
            $("#ModalFullscreen .modal-body").removeClass('running');
        } else {
            alert(data.msg);
        }
    });
    req.fail(function(xhr){
        modal_body.html("<h1 class='text-danger text-center'>Content failed to load</h1>");
        $("#ModalFullscreen .modal-body").removeClass('running');
        console.log("Xhr Error");
    });
}

// Fetch Cards
function fetch_cards(){
    modal = $("#CardModal");
    modal_body = $('#card-modal-ajax-content');
    var data = {}
    var req = ajax_request("./backend/card-actions?action=fetch", data, false);
    req.done(function(data){
        if(data.code == 200){
            modal_body.html(data.html);
            $("#CardModal .modal-body").removeClass('running');
        } else {
            alert(data.msg);
        }
    });
    req.fail(function(xhr){
        modal_body.html("<h1 class='text-danger text-center'>Content failed to load</h1>");
        $("#CardModal .modal-body").removeClass('running');
        console.log("Xhr Error");
    });
}

// Fetch Roles
function fetch_roles(){
    modal = $("#CardModal");
    modal_body = $('#card-modal-ajax-content');
    var data = {}
    var req = ajax_request("./backend/rights-actions?action=fetch", data, false);
    req.done(function(data){
        if(data.code == 200){
            modal_body.html(data.html);
            $("#CardModal .modal-body").removeClass('running');
        } else {
            alert(data.msg);
        }
    });
    req.fail(function(xhr){
        modal_body.html("<h1 class='text-danger text-center'>Content failed to load</h1>");
        $("#CardModal .modal-body").removeClass('running');
        console.log("Xhr Error");
    });
}

// Reload using pjax
function pjax_reload(){
    pjax.loadUrl(window.location.href);
}

// Custom Copy to clipboard
function fallbackCopyTextToClipboard(text) {
    var textArea = document.createElement("textarea");
    textArea.value = text;

    // Avoid scrolling to bottom
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";

    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
        var successful = document.execCommand("copy");
        var msg = successful ? "successful" : "unsuccessful";
        console.log("Fallback: Copying text command was " + msg);
    } catch (err) {
        console.error("Fallback: Oops, unable to copy", err);
    }

    document.body.removeChild(textArea);
}
function copyTextToClipboard(text) {
    if (!navigator.clipboard) {
        fallbackCopyTextToClipboard(text);
        return;
    }
    navigator.clipboard.writeText(text).then(
        function () {
            console.log("Async: Copying to clipboard was successful!");
        },
        function (err) {
            console.error("Async: Could not copy text: ", err);
        }
    );
}
$(".copy-text").click(function (event) {
    var text_to_copy = $(this).attr("to-copy");
    if (text_to_copy == "") {
        return false;
    }
    copyTextToClipboard(text_to_copy);
    alert("Copied : " + text_to_copy);
});