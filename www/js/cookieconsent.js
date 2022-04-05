/*
 CookieConsent v2.7.0-rc3
 https://www.github.com/orestbida/cookieconsent
 Author Orest Bida
 Released under the MIT License
*/
(function () {
    var Ta = function (Ma) {
        var f = {
                current_lang: "en",
                auto_language: null,
                autorun: !0,
                cookie_name: "cc_cookie",
                cookie_expiration: 182,
                cookie_domain: window.location.hostname,
                cookie_path: "/",
                cookie_same_site: "Lax",
                use_rfc_cookie: !1,
                autoclear_cookies: !0,
                revision: 0,
                script_selector: "data-cookiecategory",
            },
            k = {},
            u = {},
            S = !1,
            T = !1,
            ea = !1,
            qa = !1,
            fa = !1,
            v,
            V,
            y,
            ra,
            sa,
            W = !0,
            ta = !1,
            E = null,
            Ea = !1,
            ma,
            ua,
            va = [],
            aa = [],
            N = [],
            L = [],
            wa = [],
            ba = document.documentElement,
            M,
            x,
            H,
            O,
            Na = function (a) {
                "number" === typeof a.cookie_expiration && (f.cookie_expiration = a.cookie_expiration);
                "boolean" === typeof a.autorun && (f.autorun = a.autorun);
                "string" === typeof a.cookie_domain && (f.cookie_domain = a.cookie_domain);
                "string" === typeof a.cookie_same_site && (f.cookie_same_site = a.cookie_same_site);
                "string" === typeof a.cookie_path && (f.cookie_path = a.cookie_path);
                "string" === typeof a.cookie_name && (f.cookie_name = a.cookie_name);
                "function" === typeof a.onAccept && (ra = a.onAccept);
                "function" === typeof a.onChange && (sa = a.onChange);
                "number" === typeof a.revision && (-1 < a.revision && (f.revision = a.revision), (ta = !0));
                !0 === a.autoclear_cookies && (f.autoclear_cookies = !0);
                !0 === a.use_rfc_cookie && (f.use_rfc_cookie = !0);
                !0 === a.hide_from_bots && (Ea = navigator && ((navigator.userAgent && /bot|crawl|spider|slurp|teoma/i.test(navigator.userAgent)) || navigator.webdriver));
                f.page_scripts = !0 === a.page_scripts;
                f.page_scripts_order = !1 !== a.page_scripts_order;
                "browser" === a.auto_language || !0 === a.auto_language ? (f.auto_language = "browser") : "document" === a.auto_language && (f.auto_language = "document");
                var b = a.languages;
                a = a.current_lang;
                "browser" === f.auto_language
                    ? ((a = navigator.language || navigator.browserLanguage), 2 < a.length && (a = a[0] + a[1]), (a = a.toLowerCase()), (b = xa(a, b)))
                    : (b = "document" === f.auto_language ? xa(document.documentElement.lang, b) : "string" === typeof a ? (f.current_lang = xa(a, b)) : f.current_lang);
                f.current_lang = b;
            },
            Oa = function () {
                for (var a = document.querySelectorAll('a[data-cc="c-settings"], button[data-cc="c-settings"]'), b = 0; b < a.length; b++)
                    a[b].setAttribute("aria-haspopup", "dialog"),
                        I(a[b], "click", function (c) {
                            k.showSettings(0);
                            c.preventDefault ? c.preventDefault() : (c.returnValue = !1);
                        });
            },
            xa = function (a, b) {
                if (Object.prototype.hasOwnProperty.call(b, a)) return a;
                if (0 < ha(b).length) return Object.prototype.hasOwnProperty.call(b, f.current_lang) ? f.current_lang : ha(b)[0];
            },
            Fa = function () {
                function a(c, d) {
                    var e = !1,
                        h = !1;
                    try {
                        for (var l = c.querySelectorAll(b.join(':not([tabindex="-1"]), ')), m, n = l.length, p = 0; p < n; )
                            (m = l[p].getAttribute("data-focus")), h || "1" !== m ? "0" === m && ((e = l[p]), h || "0" === l[p + 1].getAttribute("data-focus") || (h = l[p + 1])) : (h = l[p]), p++;
                    } catch (r) {
                        return c.querySelectorAll(b.join(", "));
                    }
                    d[0] = l[0];
                    d[1] = l[l.length - 1];
                    d[2] = e;
                    d[3] = h;
                }
                var b = ["[href]", "button", "input", "details", '[tabindex="0"]'];
                a(O, aa);
                S && a(x, va);
            },
            ya,
            za,
            Ga = "",
            ia,
            Pa = function (a, b) {
                M = g("div");
                M.id = "cc--main";
                M.style.position = "fixed";
                M.style.zIndex = "1000000";
                M.innerHTML = '\x3c!--[if lt IE 9 ]><div id="cc_div" class="cc_div ie"></div><![endif]--\x3e\x3c!--[if (gt IE 8)|!(IE)]>\x3c!--\x3e<div id="cc_div" class="cc_div"></div>\x3c!--<![endif]--\x3e';
                var c = M.children[0],
                    d = f.current_lang,
                    e = "string" === typeof ba.textContent ? "textContent" : "innerText";
                ya = b;
                za = function (z) {
                    !0 === z.force_consent && J(ba, "force--consent");
                    var P = z.languages[d].consent_modal.description;
                    ta && (P = W ? P.replace("{{revision_message}}", "") : P.replace("{{revision_message}}", Ga || z.languages[d].consent_modal.revision_message || ""));
                    if (x) ia.innerHTML = P;
                    else {
                        x = g("div");
                        var X = g("div"),
                            na = g("div"),
                            ja = g("div");
                        ia = g("div");
                        var oa = g("div"),
                            ka = g("button"),
                            ca = g("button"),
                            pa = g("div");
                        x.id = "cm";
                        X.id = "c-inr";
                        na.id = "c-inr-i";
                        ja.id = "c-ttl";
                        ia.id = "c-txt";
                        oa.id = "c-bns";
                        ka.id = "c-p-bn";
                        ca.id = "c-s-bn";
                        pa.id = "cm-ov";
                        ka.className = "c-bn";
                        ca.className = "c-bn c_link sfactory";
                        ja.setAttribute("role", "heading");
                        ja.setAttribute("aria-level", "2");
                        x.setAttribute("role", "dialog");
                        x.setAttribute("aria-modal", "true");
                        x.setAttribute("aria-hidden", "false");
                        x.setAttribute("aria-labelledby", "c-ttl");
                        x.setAttribute("aria-describedby", "c-txt");
                        x.style.visibility = pa.style.visibility = "hidden";
                        pa.style.opacity = 0;
                        ja.insertAdjacentHTML("beforeend", z.languages[d].consent_modal.title);
                        ia.insertAdjacentHTML("beforeend", P);
                        ka[e] = z.languages[d].consent_modal.primary_btn.text;
                        ca[e] = z.languages[d].consent_modal.secondary_btn.text;
                        var Ha;
                        "accept_all" === z.languages[d].consent_modal.primary_btn.role && (Ha = "all");
                        I(ka, "click", function () {
                            k.hide();
                            k.accept(Ha);
                        });
                        "accept_necessary" === z.languages[d].consent_modal.secondary_btn.role
                            ? I(ca, "click", function () {
                                k.hide();
                                k.accept([]);
                            })
                            : I(ca, "click", function () {
                                k.showSettings(0);
                            });
                        na.appendChild(ja);
                        na.appendChild(ia);
                        oa.appendChild(ka);
                        oa.appendChild(ca);
                        X.appendChild(na);
                        X.appendChild(oa);
                        x.appendChild(X);
                        c.appendChild(x);
                        c.appendChild(pa);
                        S = !0;
                    }
                };
                a || za(b);
                H = g("div");
                var h = g("div"),
                    l = g("div"),
                    m = g("div");
                O = g("div");
                var n = g("div"),
                    p = g("div"),
                    r = g("button"),
                    U = g("div"),
                    Q = g("div"),
                    A = g("div");
                H.id = "s-cnt";
                h.id = "c-vln";
                m.id = "c-s-in";
                l.id = "cs";
                n.id = "s-ttl";
                O.id = "s-inr";
                p.id = "s-hdr";
                Q.id = "s-bl";
                r.id = "s-c-bn";
                A.id = "cs-ov";
                U.id = "s-c-bnc";
                r.className = "c-bn";
                r.setAttribute("aria-label", b.languages[d].settings_modal.close_btn_label || "Close");
                H.setAttribute("role", "dialog");
                H.setAttribute("aria-modal", "true");
                H.setAttribute("aria-hidden", "true");
                H.setAttribute("aria-labelledby", "s-ttl");
                n.setAttribute("role", "heading");
                H.style.visibility = A.style.visibility = "hidden";
                A.style.opacity = 0;
                U.appendChild(r);
                I(
                    h,
                    "keydown",
                    function (z) {
                        z = z || window.event;
                        27 === z.keyCode && k.hideSettings(0);
                    },
                    !0
                );
                I(r, "click", function () {
                    k.hideSettings(0);
                });
                y = b.languages[f.current_lang].settings_modal.blocks;
                V = b.languages[f.current_lang].settings_modal.cookie_table_headers;
                r = y.length;
                n.insertAdjacentHTML("beforeend", b.languages[f.current_lang].settings_modal.title);
                for (var q = 0; q < r; ++q) {
                    var w = g("div"),
                        B = g("div"),
                        t = g("div"),
                        F = g("div");
                    w.className = "c-bl";
                    B.className = "desc";
                    t.className = "p";
                    F.className = "title";
                    t.insertAdjacentHTML("beforeend", y[q].description);
                    if ("undefined" !== typeof y[q].toggle) {
                        var C = "c-ac-" + q,
                            Y = g("button"),
                            G = g("label"),
                            D = g("input"),
                            R = g("span"),
                            Z = g("span"),
                            da = g("span"),
                            Ia = g("span");
                        Y.className = "b-tl";
                        G.className = "b-tg";
                        D.className = "c-tgl";
                        da.className = "on-i";
                        Ia.className = "off-i";
                        R.className = "c-tg";
                        Z.className = "t-lb";
                        Y.setAttribute("aria-expanded", "false");
                        Y.setAttribute("aria-controls", C);
                        D.type = "checkbox";
                        R.setAttribute("aria-hidden", "true");
                        var Aa = y[q].toggle.value;
                        D.value = Aa;
                        Z[e] = y[q].title;
                        Y.insertAdjacentHTML("beforeend", y[q].title);
                        F.appendChild(Y);
                        R.appendChild(da);
                        R.appendChild(Ia);
                        a ? (-1 < K(u.level, Aa) ? ((D.checked = !0), N.push(!0)) : N.push(!1)) : y[q].toggle.enabled ? ((D.checked = !0), N.push(!0)) : N.push(!1);
                        L.push(Aa);
                        y[q].toggle.readonly ? ((D.disabled = !0), J(R, "c-ro"), wa.push(!0)) : wa.push(!1);
                        J(B, "b-acc");
                        J(F, "b-bn");
                        J(w, "b-ex");
                        B.id = C;
                        B.setAttribute("aria-hidden", "true");
                        G.appendChild(D);
                        G.appendChild(R);
                        G.appendChild(Z);
                        F.appendChild(G);
                        (function (z, P, X) {
                            I(
                                Y,
                                "click",
                                function () {
                                    Ja(P, "act")
                                        ? (Ba(P, "act"), X.setAttribute("aria-expanded", "false"), z.setAttribute("aria-hidden", "true"))
                                        : (J(P, "act"), X.setAttribute("aria-expanded", "true"), z.setAttribute("aria-hidden", "false"));
                                },
                                !1
                            );
                        })(B, w, Y);
                    } else (C = g("div")), (C.className = "b-tl"), C.setAttribute("role", "heading"), C.setAttribute("aria-level", "3"), C.insertAdjacentHTML("beforeend", y[q].title), F.appendChild(C);
                    w.appendChild(F);
                    B.appendChild(t);
                    if (!0 !== b.remove_cookie_tables && "undefined" !== typeof y[q].cookie_table) {
                        C = document.createDocumentFragment();
                        for (G = 0; G < V.length; ++G) (D = g("th")), (t = V[G]), D.setAttribute("scope", "col"), t && ((F = t && ha(t)[0]), (D[e] = V[G][F]), C.appendChild(D));
                        t = g("tr");
                        t.appendChild(C);
                        F = g("thead");
                        F.appendChild(t);
                        C = g("table");
                        C.appendChild(F);
                        G = document.createDocumentFragment();
                        for (D = 0; D < y[q].cookie_table.length; D++) {
                            R = g("tr");
                            for (Z = 0; Z < V.length; ++Z) if ((t = V[Z])) (F = ha(t)[0]), (da = g("td")), da.insertAdjacentHTML("beforeend", y[q].cookie_table[D][F]), da.setAttribute("data-column", t[F]), R.appendChild(da);
                            G.appendChild(R);
                        }
                        t = g("tbody");
                        t.appendChild(G);
                        C.appendChild(t);
                        B.appendChild(C);
                    }
                    w.appendChild(B);
                    Q.appendChild(w);
                }
                a = g("div");
                r = g("button");
                q = g("button");
                a.id = "s-bns";
                r.id = "s-sv-bn";
                q.id = "s-all-bn";
                r.className = "c-bn";
                q.className = "c-bn";
                r.insertAdjacentHTML("beforeend", b.languages[f.current_lang].settings_modal.save_settings_btn);
                q.insertAdjacentHTML("beforeend", b.languages[f.current_lang].settings_modal.accept_all_btn);
                a.appendChild(q);
                if ((b = b.languages[f.current_lang].settings_modal.reject_all_btn))
                    (w = g("button")),
                        (w.id = "s-rall-bn"),
                        (w.className = "c-bn"),
                        w.insertAdjacentHTML("beforeend", b),
                        I(w, "click", function () {
                            k.hideSettings();
                            k.hide();
                            k.accept([]);
                        }),
                        (O.className = "bns-t"),
                        a.appendChild(w);
                a.appendChild(r);
                I(r, "click", function () {
                    k.hideSettings();
                    k.hide();
                    k.accept();
                });
                I(q, "click", function () {
                    k.hideSettings();
                    k.hide();
                    k.accept("all");
                });
                p.appendChild(n);
                p.appendChild(U);
                O.appendChild(p);
                O.appendChild(Q);
                O.appendChild(a);
                m.appendChild(O);
                l.appendChild(m);
                h.appendChild(l);
                H.appendChild(h);
                c.appendChild(H);
                c.appendChild(A);
                (Ma || document.body).appendChild(M);
            },
            Qa = function (a) {
                var b = document.querySelectorAll(".c-tgl") || [],
                    c = [],
                    d = !1;
                if (0 < b.length) {
                    for (var e = 0; e < b.length; e++) -1 !== K(a, L[e]) ? ((b[e].checked = !0), N[e] || (c.push(L[e]), (N[e] = !0))) : ((b[e].checked = !1), N[e] && (c.push(L[e]), (N[e] = !1)));
                    if (f.autoclear_cookies && T && 0 < c.length) {
                        b = y.length;
                        e = -1;
                        var h = la("", "all"),
                            l = [f.cookie_domain, "." + f.cookie_domain];
                        if ("www." === f.cookie_domain.slice(0, 4)) {
                            var m = f.cookie_domain.substr(4);
                            l.push(m);
                            l.push("." + m);
                        }
                        for (m = 0; m < b; m++) {
                            var n = y[m];
                            if (Object.prototype.hasOwnProperty.call(n, "toggle") && !N[++e] && Object.prototype.hasOwnProperty.call(n, "cookie_table") && -1 < K(c, n.toggle.value)) {
                                var p = n.cookie_table,
                                    r = ha(V[0])[0],
                                    U = p.length;
                                "on_disable" === n.toggle.reload && (d = !0);
                                for (var Q = 0; Q < U; Q++) {
                                    var A = p[Q],
                                        q = [],
                                        w = A[r],
                                        B = A.is_regex || !1,
                                        t = A.domain || null;
                                    A = A.path || !1;
                                    t && (l = [t, "." + t]);
                                    if (B) for (B = 0; B < h.length; B++) h[B].match(w) && q.push(h[B]);
                                    else (w = K(h, w)), -1 < w && q.push(h[w]);
                                    0 < q.length && (Ka(q, A, l), "on_clear" === n.toggle.reload && (d = !0));
                                }
                            }
                        }
                    }
                }
                u = { level: a, revision: f.revision, data: E, rfc_cookie: f.use_rfc_cookie };
                if (!T || 0 < c.length || !W) (W = !0), Ca(f.cookie_name, JSON.stringify(u)), Da();
                if ("function" === typeof ra && !T) return (T = !0), ra(u);
                "function" === typeof sa && 0 < c.length && sa(u, c);
                d && window.location.reload();
            },
            Ra = function (a, b) {
                if ("string" !== typeof a || "" === a || document.getElementById("cc--style")) b();
                else {
                    var c = g("style");
                    c.id = "cc--style";
                    var d = new XMLHttpRequest();
                    d.onreadystatechange = function () {
                        4 === this.readyState &&
                        200 === this.status &&
                        (c.setAttribute("type", "text/css"),
                            c.styleSheet ? (c.styleSheet.cssText = this.responseText) : c.appendChild(document.createTextNode(this.responseText)),
                            document.getElementsByTagName("head")[0].appendChild(c),
                            b());
                    };
                    d.open("GET", a);
                    d.send();
                }
            },
            K = function (a, b) {
                for (var c = a.length, d = 0; d < c; d++) if (a[d] === b) return d;
                return -1;
            },
            g = function (a) {
                var b = document.createElement(a);
                "button" === a && b.setAttribute("type", a);
                return b;
            },
            Sa = function () {
                var a = !1,
                    b = !1;
                I(document, "keydown", function (c) {
                    c = c || window.event;
                    "Tab" === c.key &&
                    (v &&
                    (c.shiftKey ? document.activeElement === v[0] && (v[1].focus(), c.preventDefault()) : document.activeElement === v[1] && (v[0].focus(), c.preventDefault()),
                    b || fa || ((b = !0), !a && c.preventDefault(), c.shiftKey ? (v[3] ? (v[2] ? v[2].focus() : v[0].focus()) : v[1].focus()) : v[3] ? v[3].focus() : v[0].focus())),
                    !b && (a = !0));
                });
                document.contains &&
                I(
                    M,
                    "click",
                    function (c) {
                        c = c || window.event;
                        qa ? (O.contains(c.target) ? (fa = !0) : (k.hideSettings(0), (fa = !1))) : ea && x.contains(c.target) && (fa = !0);
                    },
                    !0
                );
            },
            La = function (a, b) {
                function c(e, h, l, m, n, p, r) {
                    p = (p && p.split(" ")) || [];
                    if (-1 < K(h, n) && (J(e, n), ("bar" !== n || "middle" !== p[0]) && -1 < K(l, p[0]))) for (h = 0; h < p.length; h++) J(e, p[h]);
                    -1 < K(m, r) && J(e, r);
                }
                if ("object" === typeof a) {
                    var d = a.consent_modal;
                    a = a.settings_modal;
                    S && d && c(x, ["box", "bar", "cloud"], ["top", "middle", "bottom"], ["zoom", "slide"], d.layout, d.position, d.transition);
                    !b && a && c(H, ["bar"], ["left", "right"], ["zoom", "slide"], a.layout, a.position, a.transition);
                }
            };
        k.allowedCategory = function (a) {
            return -1 < K(JSON.parse(la(f.cookie_name, "one", !0) || "{}").level || [], a);
        };
        k.run = function (a) {
            if (
                !document.getElementById("cc_div") &&
                (Na(a),
                !Ea &&
                ((u = JSON.parse(la(f.cookie_name, "one", !0) || "{}")),
                    (T = void 0 !== u.level),
                    (E = void 0 !== u.data ? u.data : null),
                    (W = "number" === typeof a.revision ? (T ? (-1 < a.revision ? u.revision === f.revision : !0) : !0) : !0),
                    (S = !T || !W),
                    Pa(!S, a),
                    Ra(a.theme_css, function () {
                        Fa();
                        La(a.gui_options);
                        Oa();
                        f.autorun && S && k.show(a.delay || 0);
                        setTimeout(function () {
                            J(M, "c--anim");
                        }, 30);
                        setTimeout(function () {
                            Sa();
                        }, 100);
                    }),
                T && W))
            ) {
                var b = "boolean" === typeof u.rfc_cookie;
                if (!b || (b && u.rfc_cookie !== f.use_rfc_cookie)) (u.rfc_cookie = f.use_rfc_cookie), Ca(f.cookie_name, JSON.stringify(u));
                Da();
                if ("function" === typeof a.onAccept) a.onAccept(u);
            }
        };
        k.showSettings = function (a) {
            setTimeout(
                function () {
                    J(ba, "show--settings");
                    H.setAttribute("aria-hidden", "false");
                    qa = !0;
                    setTimeout(function () {
                        ea ? (ua = document.activeElement) : (ma = document.activeElement);
                        0 !== aa.length && (aa[3] ? aa[3].focus() : aa[0].focus(), (v = aa));
                    }, 200);
                },
                0 < a ? a : 0
            );
        };
        var Da = function () {
            if (f.page_scripts) {
                var a = document.querySelectorAll("script[" + f.script_selector + "]"),
                    b = f.page_scripts_order,
                    c = u.level || [],
                    d = function (e, h) {
                        if (h < e.length) {
                            var l = e[h],
                                m = l.getAttribute(f.script_selector);
                            if (-1 < K(c, m)) {
                                l.type = "text/javascript";
                                l.removeAttribute(f.script_selector);
                                m = l.getAttribute("data-src");
                                var n = g("script");
                                n.textContent = l.innerHTML;
                                (function (p, r) {
                                    for (var U = r.attributes, Q = U.length, A = 0; A < Q; A++) (r = U[A]), p.setAttribute(r.nodeName, r.nodeValue);
                                })(n, l);
                                m ? (n.src = m) : (m = l.src);
                                m &&
                                (b
                                    ? n.readyState
                                        ? (n.onreadystatechange = function () {
                                            if ("loaded" === n.readyState || "complete" === n.readyState) (n.onreadystatechange = null), d(e, ++h);
                                        })
                                        : (n.onload = function () {
                                            n.onload = null;
                                            d(e, ++h);
                                        })
                                    : (m = !1));
                                l.parentNode.replaceChild(n, l);
                                if (m) return;
                            }
                            d(e, ++h);
                        }
                    };
                d(a, 0);
            }
        };
        k.set = function (a, b) {
            switch (a) {
                case "data":
                    a = b.value;
                    var c = !1;
                    if ("update" === b.mode)
                        if (((E = k.get("data")), (b = typeof E === typeof a) && "object" === typeof E)) {
                            !E && (E = {});
                            for (var d in a) E[d] !== a[d] && ((E[d] = a[d]), (c = !0));
                        } else (!b && E) || E === a || ((E = a), (c = !0));
                    else (E = a), (c = !0);
                    c && ((u.data = E), Ca(f.cookie_name, JSON.stringify(u)));
                    return c;
                case "revision":
                    return (
                        (d = b.value),
                            (a = b.prompt_consent),
                            (b = b.message),
                            M && "number" === typeof d && u.revision !== d ? ((ta = !0), (Ga = b), (W = !1), (f.revision = d), !0 === a ? (za(ya), La(ya.gui_options, !0), Fa(), k.show()) : k.accept(), (b = !0)) : (b = !1),
                            b
                    );
                default:
                    return !1;
            }
        };
        k.get = function (a, b) {
            return JSON.parse(la(b || f.cookie_name, "one", !0) || "{}")[a];
        };
        k.getConfig = function (a) {
            return f[a];
        };
        k.loadScript = function (a, b, c) {
            var d = "function" === typeof b;
            if (document.querySelector('script[src="' + a + '"]')) d && b();
            else {
                var e = g("script");
                if (c && 0 < c.length) for (var h = 0; h < c.length; ++h) c[h] && e.setAttribute(c[h].name, c[h].value);
                d &&
                (e.readyState
                    ? (e.onreadystatechange = function () {
                        if ("loaded" === e.readyState || "complete" === e.readyState) (e.onreadystatechange = null), b();
                    })
                    : (e.onload = b));
                e.src = a;
                (document.head ? document.head : document.getElementsByTagName("head")[0]).appendChild(e);
            }
        };
        k.updateScripts = function () {
            Da();
        };
        k.show = function (a) {
            S &&
            setTimeout(
                function () {
                    J(ba, "show--consent");
                    x.setAttribute("aria-hidden", "false");
                    ea = !0;
                    setTimeout(function () {
                        ma = document.activeElement;
                        v = va;
                    }, 200);
                },
                0 < a ? a : 0
            );
        };
        k.hide = function () {
            S &&
            (Ba(ba, "show--consent"),
                x.setAttribute("aria-hidden", "true"),
                (ea = !1),
                setTimeout(function () {
                    ma.focus();
                    v = null;
                }, 200));
        };
        k.hideSettings = function () {
            Ba(ba, "show--settings");
            qa = !1;
            H.setAttribute("aria-hidden", "true");
            setTimeout(function () {
                ea ? (ua && ua.focus(), (v = va)) : (ma.focus(), (v = null));
                fa = !1;
            }, 200);
        };
        k.accept = function (a, b) {
            a = a || void 0;
            var c = b || [];
            b = [];
            var d = function () {
                for (var h = document.querySelectorAll(".c-tgl") || [], l = [], m = 0; m < h.length; m++) h[m].checked && l.push(h[m].value);
                return l;
            };
            if (a)
                if ("object" === typeof a && "number" === typeof a.length) for (var e = 0; e < a.length; e++) -1 !== K(L, a[e]) && b.push(a[e]);
                else "string" === typeof a && ("all" === a ? (b = L.slice()) : -1 !== K(L, a) && b.push(a));
            else b = d();
            if (1 <= c.length)
                for (e = 0; e < c.length; e++)
                    b = b.filter(function (h) {
                        return h !== c[e];
                    });
            for (e = 0; e < L.length; e++) !0 === wa[e] && -1 === K(b, L[e]) && b.push(L[e]);
            Qa(b);
        };
        k.eraseCookies = function (a, b, c) {
            var d = [];
            c = c ? [c, "." + c] : [f.cookie_domain, "." + f.cookie_domain];
            if ("object" === typeof a && 0 < a.length) for (var e = 0; e < a.length; e++) this.validCookie(a[e]) && d.push(a[e]);
            else this.validCookie(a) && d.push(a);
            Ka(d, b, c);
        };
        var Ca = function (a, b) {
                b = f.use_rfc_cookie ? encodeURIComponent(b) : b;
                var c = new Date();
                c.setTime(c.getTime() + 864e5 * f.cookie_expiration);
                c = "; expires=" + c.toUTCString();
                a = a + "=" + (b || "") + c + "; Path=" + f.cookie_path + ";";
                a += " SameSite=" + f.cookie_same_site + ";";
                -1 < window.location.hostname.indexOf(".") && (a += " Domain=" + f.cookie_domain + ";");
                "https:" === window.location.protocol && (a += " Secure;");
                document.cookie = a;
            },
            la = function (a, b, c) {
                var d;
                if ("one" === b) {
                    if ((d = (d = document.cookie.match("(^|;)\\s*" + a + "\\s*=\\s*([^;]+)")) ? (c ? d.pop() : a) : "") && a === f.cookie_name) {
                        try {
                            d = JSON.parse(d);
                        } catch (e) {
                            try {
                                d = JSON.parse(decodeURIComponent(d));
                            } catch (h) {
                                d = {};
                            }
                        }
                        d = JSON.stringify(d);
                    }
                } else if ("all" === b) for (a = document.cookie.split(/;\s*/), d = [], b = 0; b < a.length; b++) d.push(a[b].split("=")[0]);
                return d;
            },
            Ka = function (a, b, c) {
                b = b ? b : "/";
                for (var d = 0; d < a.length; d++) for (var e = 0; e < c.length; e++) document.cookie = a[d] + "=; path=" + b + (-1 < c[e].indexOf(".") ? "; domain=" + c[e] : "") + "; Expires=Thu, 01 Jan 1970 00:00:01 GMT;";
            };
        k.validCookie = function (a) {
            return "" !== la(a, "one", !0);
        };
        var I = function (a, b, c, d) {
                a.addEventListener ? (!0 === d ? a.addEventListener(b, c, { passive: !0 }) : a.addEventListener(b, c, !1)) : a.attachEvent("on" + b, c);
            },
            ha = function (a) {
                if ("object" === typeof a) {
                    var b = [],
                        c = 0;
                    for (b[c++] in a);
                    return b;
                }
            },
            J = function (a, b) {
                a.classList ? a.classList.add(b) : Ja(a, b) || (a.className += " " + b);
            },
            Ba = function (a, b) {
                a.classList ? a.classList.remove(b) : (a.className = a.className.replace(new RegExp("(\\s|^)" + b + "(\\s|$)"), " "));
            },
            Ja = function (a, b) {
                return a.classList ? a.classList.contains(b) : !!a.className.match(new RegExp("(\\s|^)" + b + "(\\s|$)"));
            };
        return k;
    };
    "function" !== typeof window.initCookieConsent && (window.initCookieConsent = Ta);
})();
