/**
 * Sets option of dropdown field
 * @param selectElement Dropdown element
 * @param value Value to be set
 * @returns {boolean} True if successful, false if not
 */
function setOption(selectElement, value) {
    var options = selectElement.options;
    for (var i = 0; i < options.length; i++) {
        if (options[i].value == value) {
            selectElement.selectedIndex = i;
            return true;
        }
    }
    return false;
}

/**
 * Selects league in league dropdown field
 */
function selectLeague(){
    setOption(document.getElementById('league_select'), document.getElementById('leagueid').value);
}
/**
 * Selects game in game dropdown field
 */
function selectGame(){
    setOption(document.getElementById('game_select'), document.getElementById('gameid').value);
}

/**
 * Confirmation of delete via popup window
 * @param id Id of item to be deleted (model depends on where is function called from)
 */
function confirmDelete(id){
    $("#delete"+id).on("submit", function(){
        return confirm("Do you want to delete this item?");
    });
}

/**
 * Ajax request to check nickname availability
 * Request is build only if input is not empty
 */
function checkUserNicknameAvailability() {
    if($('#nickname').val() != "") {
        $('#user-availability-status').html("");
        $('#loading-icon-user').show();
        $.ajax({
            url: '/checkNickNameAvailability',
            type: 'POST',
            data: {'nickname': $('#nickname').val(), '_token': $('input[name=_token]').val()},
            success: function (response) {
                $('#loading-icon-user').hide();
                $('#user-availability-status').html(response);
            },
            error: function () {
                $('#loading-icon-user').hide();
                $("#user-availability-status").html("something wrong");
            }
        });
    }
}

/**
 * Ajax request to check email availability
 * Request is build only if input is not empty
 */
function checkUserEmailAvailability() {
    if($('#email').val() != ""){
        $('#email-availability-status').html("");
        $('#loading-icon-mail').show();
        $.ajax({
            url: '/checkEmailAvailability',
            type: 'POST',
            data: {'mail':$('#email').val(), '_token': $('input[name=_token]').val()},
            success: function(response)
            {
                $('#loading-icon-mail').hide();
                $('#email-availability-status').html(response);
            },
            error:function (){
                $('#loading-icon-mail').hide();
                $("#email-availability-status").html("something wrong");
            }
        });
    }
}

/**
 * Hides loading icons for gui of ajax requests in user form
 */
function hideLoadingIcons(){
    $('#loading-icon-user').hide();
    $('#loading-icon-mail').hide();
}

/**
 * Hides errors
 */
function hideErrors() {
    var errordiv = document.getElementById("errordiv");
    errordiv.className = 'not-visible';
};

function uploadImage() {
    var selectedFile = $('#avatar').get(0).files[0];
    var data = new FormData();
    data.append('image', selectedFile);
    data.append('_token', $('input[name=_token]').val());
    $.ajax({
        url: "/uploadAvatar",
        headers: {"Accept": "application/json"},
        type: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            $("#targetLayer").html(data);
        },
        error: function () {
        }
    });
}



