const $content = `
<div class="template-customizer-theming">
  <h5 class="m-0 px-6 py-6">
    <span class="template-customizer-t-theming_header bg-label-primary rounded-1 py-1 px-3 small">Tema</span>
  </h5>
  <div class="m-0 px-6 pb-6 template-customizer-style w-100">
    <label for="customizerStyle" class="form-label d-block template-customizer-t-style_label mb-2">Gaya (Mode)</label>
    <div class="row px-1 template-customizer-styles-options">
      <div class="col-4 px-2">
        <div class="form-check custom-option custom-option-icon">
          <label class="form-check-label custom-option-content p-0" for="customRadioIconlight">
            <span class="custom-option-body mb-0">
              <img src="/assets/img/customizer/light-dark.svg" alt="Light" class="img-fluid scaleX-n1-rtl">
            </span>
            <input name="customRadioIcon" class="form-check-input d-none" type="radio" value="light" id="customRadioIconlight">
          </label>
        </div>
        <label class="form-check-label small text-nowrap text-body mt-1" for="customRadioIconlight">Light</label>
      </div>
      <div class="col-4 px-2">
        <div class="form-check custom-option custom-option-icon checked">
          <label class="form-check-label custom-option-content p-0" for="customRadioIcondark">
            <span class="custom-option-body mb-0">
              <img src="/assets/img/customizer/dark-dark.svg" alt="Dark" class="img-fluid scaleX-n1-rtl">
            </span>
            <input name="customRadioIcon" class="form-check-input d-none" type="radio" value="dark" id="customRadioIcondark" checked>
          </label>
        </div>
        <label class="form-check-label small text-nowrap text-body mt-1" for="customRadioIcondark">Dark</label>
      </div>
      <div class="col-4 px-2">
        <div class="form-check custom-option custom-option-icon">
          <label class="form-check-label custom-option-content p-0" for="customRadioIconsystem">
            <span class="custom-option-body mb-0">
              <img src="/assets/img/customizer/system-dark.svg" alt="System" class="img-fluid scaleX-n1-rtl">
            </span>
            <input name="customRadioIcon" class="form-check-input d-none" type="radio" value="system" id="customRadioIconsystem">
          </label>
        </div>
        <label class="form-check-label small text-nowrap text-body mt-1" for="customRadioIconsystem">System</label>
      </div>
    </div>
  </div>
  <div class="m-0 px-6 template-customizer-themes w-100">
    <label for="customizerTheme" class="form-label template-customizer-t-theme_label mb-2">Tema</label>
    <div class="row px-1 template-customizer-themes-options">
      <div class="col-4 px-2">
        <div class="form-check custom-option custom-option-icon">
          <label class="form-check-label custom-option-content p-0" for="themeRadiostheme-default">
            <span class="custom-option-body mb-0">
              <img src="/assets/img/customizer/default-dark.svg" alt="Default" class="img-fluid scaleX-n1-rtl">
            </span>
            <input name="themeRadios" class="form-check-input d-none" type="radio" value="theme-default" id="themeRadiostheme-default">
          </label>
        </div>
        <label class="form-check-label small text-nowrap text-body mt-1" for="themeRadiostheme-default">Default</label>
      </div>
      <div class="col-4 px-2">
        <div class="form-check custom-option custom-option-icon">
          <label class="form-check-label custom-option-content p-0" for="themeRadiostheme-bordered">
            <span class="custom-option-body mb-0">
              <img src="/assets/img/customizer/border-dark.svg" alt="Bordered" class="img-fluid scaleX-n1-rtl">
            </span>
            <input name="themeRadios" class="form-check-input d-none" type="radio" value="theme-bordered" id="themeRadiostheme-bordered">
          </label>
        </div>
        <label class="form-check-label small text-nowrap text-body mt-1" for="themeRadiostheme-bordered">Bordered</label>
      </div>
      <div class="col-4 px-2">
        <div class="form-check custom-option custom-option-icon checked">
          <label class="form-check-label custom-option-content p-0" for="themeRadiostheme-semi-dark">
            <span class="custom-option-body mb-0">
              <img src="/assets/img/customizer/semi-dark-dark.svg" alt="Semi Dark" class="img-fluid scaleX-n1-rtl">
            </span>
            <input name="themeRadios" class="form-check-input d-none" type="radio" value="theme-semi-dark" id="themeRadiostheme-semi-dark" checked>
          </label>
        </div>
        <label class="form-check-label small text-nowrap text-body mt-1" for="themeRadiostheme-semi-dark">Semi Dark</label>
      </div>
    </div>
  </div>
</div>
`;

document.addEventListener("DOMContentLoaded", () => {
    const container = document.querySelector(".template-customizer-inner");
    if (container) {
        container.innerHTML += $content;
    } else {
        console.error(
            "Elemen dengan kelas 'template-customizer-inner' tidak ditemukan."
        );
    }
});
