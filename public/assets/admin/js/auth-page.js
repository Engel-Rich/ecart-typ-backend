"use strict";
$(document).on('ready', function () {
    // INITIALIZATION OF SHOW PASSWORD
    // =======================================================
    $('.js-toggle-password').each(function () {
        new HSTogglePassword(this).init()
    });

    // INITIALIZATION OF FORM VALIDATION
    // =======================================================
    $('.js-validate').each(function () {
        $.HSCore.components.HSValidation.init($(this));
    });
});

"use strict";

$(".copy_cred").on('click', function(){
    copy_cred();
});
function copy_cred() {
    $('#signinEmail').val('admin@admin.com');
    $('#signinPassword').val('12345678');
    toastr.success('Copied successfully!', 'Success!', {
        CloseButton: true,
        ProgressBar: true
    });
}
