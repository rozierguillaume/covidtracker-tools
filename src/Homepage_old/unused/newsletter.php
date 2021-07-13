<!-- Begin Sendinblue Form -->
<!-- START - We recommend to place the below code in head tag of your website html  -->
<style>
    @font-face {
        font-display: block;
        font-family: Roboto;
        src: url(https://assets.sendinblue.com/font/Roboto/Latin/normal/normal/7529907e9eaf8ebb5220c5f9850e3811.woff2) format("woff2"), url(https://assets.sendinblue.com/font/Roboto/Latin/normal/normal/25c678feafdc175a70922a116c9be3e7.woff) format("woff")
    }

    @font-face {
        font-display: fallback;
        font-family: Roboto;
        font-weight: 600;
        src: url(https://assets.sendinblue.com/font/Roboto/Latin/medium/normal/6e9caeeafb1f3491be3e32744bc30440.woff2) format("woff2"), url(https://assets.sendinblue.com/font/Roboto/Latin/medium/normal/71501f0d8d5aa95960f6475d5487d4c2.woff) format("woff")
    }

    @font-face {
        font-display: fallback;
        font-family: Roboto;
        font-weight: 700;
        src: url(https://assets.sendinblue.com/font/Roboto/Latin/bold/normal/3ef7cf158f310cf752d5ad08cd0e7e60.woff2) format("woff2"), url(https://assets.sendinblue.com/font/Roboto/Latin/bold/normal/ece3a1d82f18b60bcce0211725c476aa.woff) format("woff")
    }

    #sib-container input:-ms-input-placeholder {
        text-align: left;
        font-family: "Helvetica", sans-serif;
        color: #c0ccda;
    }

    #sib-container input::placeholder {
        text-align: left;
        font-family: "Helvetica", sans-serif;
        color: #c0ccda;
    }

    #sib-container textarea::placeholder {
        text-align: left;
        font-family: "Helvetica", sans-serif;
        color: #c0ccda;
    }
</style>
<link rel="stylesheet" href="https://sibforms.com/forms/end-form/build/sib-styles.css">
<!--  END - We recommend to place the above code in head tag of your website html -->

<!-- START - We recommend to place the below code where you want the form in your website html  -->
<div class="sib-form" style="text-align: center; background-color: #ffffff; ">
    <div id="sib-form-container" class="sib-form-container">
        <div id="error-message" class="sib-form-message-panel"
             style="font-size:16px; text-align:left; font-family:&quot;Helvetica&quot;, sans-serif; color:#661d1d; background-color:#ffeded; border-radius:3px; border-color:#ff4949;max-width:540px;">
            <div class="sib-form-message-panel__text sib-form-message-panel__text--center">
                <svg viewBox="0 0 512 512" class="sib-icon sib-notification__icon">
                    <path d="M256 40c118.621 0 216 96.075 216 216 0 119.291-96.61 216-216 216-119.244 0-216-96.562-216-216 0-119.203 96.602-216 216-216m0-32C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm-11.49 120h22.979c6.823 0 12.274 5.682 11.99 12.5l-7 168c-.268 6.428-5.556 11.5-11.99 11.5h-8.979c-6.433 0-11.722-5.073-11.99-11.5l-7-168c-.283-6.818 5.167-12.5 11.99-12.5zM256 340c-15.464 0-28 12.536-28 28s12.536 28 28 28 28-12.536 28-28-12.536-28-28-28z"></path>
                </svg>
                <span class="sib-form-message-panel__inner-text">
                            Nous n'avons pas pu confirmer votre inscription.
                        </span>
            </div>
        </div>
        <div></div>
        <div id="success-message" class="sib-form-message-panel"
             style="font-size:16px; text-align:left; font-family:&quot;Helvetica&quot;, sans-serif; color:#085229; background-color:#e7faf0; border-radius:3px; border-color:#13ce66;max-width:540px;">
            <div class="sib-form-message-panel__text sib-form-message-panel__text--center">
                <svg viewBox="0 0 512 512" class="sib-icon sib-notification__icon">
                    <path d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 464c-118.664 0-216-96.055-216-216 0-118.663 96.055-216 216-216 118.664 0 216 96.055 216 216 0 118.663-96.055 216-216 216zm141.63-274.961L217.15 376.071c-4.705 4.667-12.303 4.637-16.97-.068l-85.878-86.572c-4.667-4.705-4.637-12.303.068-16.97l8.52-8.451c4.705-4.667 12.303-4.637 16.97.068l68.976 69.533 163.441-162.13c4.705-4.667 12.303-4.637 16.97.068l8.451 8.52c4.668 4.705 4.637 12.303-.068 16.97z"></path>
                </svg>
                <span class="sib-form-message-panel__inner-text">
                            Votre inscription est confirmée.
                        </span>
            </div>
        </div>
        <div></div>
        <div id="sib-container" class="sib-container--large sib-container--vertical"
             style="text-align:center; background-color:rgba(255,255,255,1); max-width:540px; border-radius:3px; border-width:1px; border-color:#C0CCD9; border-style:solid;">
            <form id="sib-form" method="POST"
                  action="https://edeef491.sibforms.com/serve/MUIEAKmsoUxvBsG9QEz82Q9bow9EaQTZNr53SUtictmWEWIjA12mQ0rok915rR9AA6ENbMjHz0HNYl8yS9iWYInuxHQfMK_v1GBIyn3gU753vrvlNP5TR1-ErcImIBGX7SVlphs9pMmpiTKISioKiONG3lIzpwJ1XMAsxuVG3skQLYlxyiaUDOqqmWwsdWgybJoOKRLhYurdptLt"
                  data-type="subscription">
                <div style="padding: 8px 0;">
                    <div class="sib-form-block" style="font-size:32px; text-align:left; font-weight:700; font-family:&quot;Helvetica&quot;, sans-serif; color:#3C4858; background-color:transparent;">
                        <p>Newsletter CovidTracker</p>
                    </div>
                </div>
                <div style="padding: 8px 0;">
                    <div class="sib-form-block" style="font-size:16px; text-align:left; font-family:&quot;Helvetica&quot;, sans-serif; color:#3C4858; background-color:transparent;">
                        <div class="sib-text-form-block">
                            <p>Inscrivez-vous à notre newsletter pour suivre nos actualités.</p>
                        </div>
                    </div>
                </div>
                <div style="padding: 8px 0;">
                    <div class="sib-input sib-form-block">
                        <div class="form__entry entry_block">
                            <div class="form__label-row ">
                                <label class="entry__label" style="font-size:16px; text-align:left; font-weight:700; font-family:&quot;Helvetica&quot;, sans-serif; color:#3c4858;" for="EMAIL" data-required="*">
                                    Veuillez renseigner votre adresse email pour vous inscrire
                                </label>

                                <div class="entry__field">
                                    <input class="input" type="text" id="EMAIL" name="EMAIL" autocomplete="off" placeholder="EMAIL" data-required="true" required="">
                                </div>
                            </div>

                            <label class="entry__error entry__error--primary"
                                   style="font-size:16px; text-align:left; font-family:&quot;Helvetica&quot;, sans-serif; color:#661d1d; background-color:#ffeded; border-radius:3px; border-color:#ff4949;">
                            </label>
                            <label class="entry__specification" style="font-size:12px; text-align:left; font-family:&quot;Helvetica&quot;, sans-serif; color:#8390A4;">
                                Veuillez renseigner votre adresse email pour vous inscrire. Ex. : abc@xyz.com
                            </label>
                        </div>
                    </div>
                </div>
                <div style="padding: 8px 0;">
                    <div class="g-recaptcha" data-sitekey="6LdoX-8ZAAAAADhP6ZVrDyCQjOFWWbbXV7WErf1e" data-callback="invisibleCaptchaCallback" data-size="invisible" onclick="executeCaptcha"></div>
                </div>
                <div style="padding: 8px 0;">
                    <div class="sib-form-block" style="text-align: left">
                        <button class="sib-form-block__button sib-form-block__button-with-loader"
                                style="font-size:16px; text-align:left; font-weight:700; font-family:&quot;Helvetica&quot;, sans-serif; color:#FFFFFF; background-color:#3E4857; border-radius:3px; border-width:0px;" form="sib-form"
                                type="submit">
                            <svg class="icon clickable__icon progress-indicator__icon sib-hide-loader-icon" viewBox="0 0 512 512">
                                <path d="M460.116 373.846l-20.823-12.022c-5.541-3.199-7.54-10.159-4.663-15.874 30.137-59.886 28.343-131.652-5.386-189.946-33.641-58.394-94.896-95.833-161.827-99.676C261.028 55.961 256 50.751 256 44.352V20.309c0-6.904 5.808-12.337 12.703-11.982 83.556 4.306 160.163 50.864 202.11 123.677 42.063 72.696 44.079 162.316 6.031 236.832-3.14 6.148-10.75 8.461-16.728 5.01z"></path>
                            </svg>
                            S'INSCRIRE
                        </button>
                    </div>
                </div>

                <input type="text" name="email_address_check" value="" class="input--hidden">
                <input type="hidden" name="locale" value="fr">
            </form>
        </div>
    </div>
</div>
<!-- END - We recommend to place the below code where you want the form in your website html  -->

<!-- START - We recommend to place the below code in footer or bottom of your website html  -->
<script>
    window.REQUIRED_CODE_ERROR_MESSAGE = 'Veuillez choisir un code pays';

    window.EMAIL_INVALID_MESSAGE = window.SMS_INVALID_MESSAGE = "Les informations que vous avez fournies ne sont pas valides. Veuillez vérifier le format du champ et réessayer.";

    window.REQUIRED_ERROR_MESSAGE = "Vous devez renseigner ce champ. ";

    window.GENERIC_INVALID_MESSAGE = "Les informations que vous avez fournies ne sont pas valides. Veuillez vérifier le format du champ et réessayer.";


    window.translation = {
        common: {
            selectedList: '{quantity} liste sélectionnée',
            selectedLists: '{quantity} listes sélectionnées'
        }
    };

    var AUTOHIDE = Boolean(0);
</script>
<script src="https://sibforms.com/forms/end-form/build/main.js">
</script>

<script src="https://www.google.com/recaptcha/api.js?hl=fr"></script>

<!-- END - We recommend to place the above code in footer or bottom of your website html  -->
<!-- End Sendinblue Form -->