var cc = initCookieConsent();
cc.run({
    current_lang: "sk",
    autoclear_cookies: true,
    theme_css: "",
    page_scripts: true,
    languages: {
        "sk": {
            consent_modal: {
                title: "Cookies",
                description: "Tento web vyžaduje súhlas na použitie cookies.",
                primary_btn: {
                    text: "OK",
                    role: "accept_all"
                },
                secondary_btn: {
                    text: "Nastavenia",
                    role: "settings"
                }
            },
            settings_modal: {
                title: "Nastavenie cookies",
                save_settings_btn: "Uložiť nastavenia",
                accept_all_btn: "Povoliť všetko",
                close_btn_label: "Zavrieť",
                blocks: [
                    {
                        title: "Technické cookies",
                        description: "Cookies nevyhnutné pre fungovanie a bezproblémové zobrazenie webu.<br>Návštevou súhlasíte s využitím týchto cookies, bez nich nie sme schopní zaistiť správne fungovanie webu.",
                        toggle: {
                            value: "necessary",
                            enabled: true,
                            readonly: true
                        }
                    }, {
                        title: "Analytické cookies",
                        description: "Cookies evidujúce Vašu návštevu nášho webu na štatistické účely. Na základe týchto dát optimalizujeme web pre používateľov notebookov, tabletov a mobilných telefónov.",
                        toggle: {
                            value: "analytics",
                            enabled: false,
                            readonly: false
                        }
                    }
                ]
            }
        }
    }
});