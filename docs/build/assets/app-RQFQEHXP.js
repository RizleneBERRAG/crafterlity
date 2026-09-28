var e=document.querySelector(`[data-simu]`);if(e){let t=JSON.parse(e.querySelector(`[data-simu-donnees]`).textContent),n=window.matchMedia(`(prefers-reduced-motion: no-preference)`).matches,r=e=>new Promise(t=>setTimeout(t,n?e:0)),i=t=>e.querySelector(`[data-etape="${t}"]`),a=e.querySelector(`[data-sortie]`),o=e.querySelector(`[data-texte]`),s=e.querySelector(`[data-urgence]`),c=e.querySelector(`[data-reprendre]`),l=null,u=`Lyon 3e`,d=0;async function f(e){let t=++d;if(o.textContent=``,o.classList.add(`frappe`),!n){o.textContent=e,o.classList.remove(`frappe`);return}for(let n=0;n<e.length;n++){if(t!==d)return;o.textContent+=e[n],await r(`,.;:`.includes(e[n])?90:14)}t===d&&o.classList.remove(`frappe`)}e.querySelectorAll(`[data-metier]`).forEach(n=>{n.addEventListener(`click`,async r=>{r.preventDefault(),l=n.dataset.metier,e.querySelectorAll(`[data-metier]`).forEach(e=>e.classList.remove(`actif`)),n.classList.add(`actif`),i(2).hidden=!1,i(3).hidden=!1,c.hidden=!1;let a=t.metiers[l].urgence;s.disabled=!a,a||(s.checked=!1),s.closest(`.simu-bascule`).classList.toggle(`inactif`,!a),p(),await f(t.exemples[l])})}),e.querySelectorAll(`[data-ville]`).forEach((t,n)=>{n===0&&t.classList.add(`actif`),t.addEventListener(`click`,()=>{e.querySelectorAll(`[data-ville]`).forEach(e=>e.classList.remove(`actif`)),t.classList.add(`actif`),u=t.textContent.trim()})}),e.querySelector(`[data-publier]`).addEventListener(`click`,async()=>{l&&await m()}),c.addEventListener(`click`,()=>{d++,l=null,o.textContent=``,s.checked=!1,e.querySelectorAll(`[data-metier]`).forEach(e=>e.classList.remove(`actif`)),i(2).hidden=!0,i(3).hidden=!0,c.hidden=!0,p()});function p(){a.innerHTML=`
            <div class="simu-vide">
                <p class="simu-legende"><span class="n">04</span> Les propositions</p>
                <p class="note">Choisissez un métier, puis publiez la demande :
                les offres des professionnels apparaîtront ici, une à une.</p>
            </div>`}async function m(){let e=s.checked;a.innerHTML=`
            <p class="simu-legende"><span class="n">04</span> Les propositions</p>
            <div class="simu-recherche">
                <div class="simu-barre" data-barre><span></span></div>
                <p class="simu-etat mono" data-etat>Envoi de la demande…</p>
            </div>
            <div class="simu-offres" data-offres></div>`;let n=a.querySelector(`[data-etat]`),i=a.querySelector(`[data-offres]`),o=e?[`Envoi de la demande…`,`Recherche dans un rayon de 5 km…`,`Trois professionnels disponibles`]:[`Envoi de la demande…`,`Recherche des professionnels du secteur…`,`Trois propositions reçues`];for(let e of o)n.textContent=e,await r(650);a.querySelector(`[data-barre]`).classList.add(`fini`);let c=t.offres[l];for(let t=0;t<c.length;t++)i.insertAdjacentHTML(`beforeend`,h(c[t],t,e)),await r(520);i.querySelectorAll(`[data-accepter]`).forEach(t=>{t.addEventListener(`click`,()=>v(c[+t.dataset.accepter],e))})}function h(e,t,n){let r=n&&e.delai!==null?`arrivée ~${e.delai} min`:e.jour;return`
            <article class="simu-offre">
                <span class="simu-rang mono">${String(t+1).padStart(2,`0`)}</span>
                <div class="simu-qui">
                    <p class="simu-nom">${e.nom} <span class="simu-ent">— ${e.entreprise}</span></p>
                    <p class="simu-meta mono">
                        <span class="simu-verif">SIRET vérifié</span>
                        <span>★ ${e.note}</span>
                        <span>${e.missions} missions</span>
                        <span>${e.km} km</span>
                    </p>
                </div>
                <div class="simu-prix">
                    <span class="simu-montant mono">${e.prix} €</span>
                    <span class="simu-quand mono">${r}</span>
                </div>
                <button type="button" class="btn petit simu-accepter" data-accepter="${t}">
                    Accepter
                </button>
            </article>`}let g=`M24 118 L24 86 L96 86 L96 46 L190 46 L190 96 L300 96 L300 34 L392 34`;function _(){return`
            <svg class="plan" viewBox="0 0 416 150" aria-hidden="true">
                <g class="plan-bati">
                    <rect x="40" y="16" width="44" height="24"/>
                    <rect x="112" y="60" width="62" height="30"/>
                    <rect x="206" y="14" width="76" height="22"/>
                    <rect x="214" y="110" width="58" height="26"/>
                    <rect x="318" y="56" width="52" height="34"/>
                    <rect x="46" y="128" width="34" height="16"/>
                </g>
                <g class="plan-rue">
                    <path d="M0 86 H416 M0 46 H416 M0 118 H416"/>
                    <path d="M96 0 V150 M190 0 V150 M300 0 V150"/>
                </g>
                <path class="plan-route" data-route d="${g}"/>
                <g class="plan-cible">
                    <circle cx="392" cy="34" r="5.5"/>
                    <circle cx="392" cy="34" r="11" fill="none"
                            stroke="currentColor" stroke-width="1.2" opacity=".35"/>
                </g>
                <circle class="plan-mobile" data-mobile r="5"
                        style="offset-path:path('${g}')"/>
            </svg>`}async function v(e,t){let i=t&&e.delai!==null?e.delai:20;a.innerHTML=`
            <p class="simu-legende"><span class="n">05</span> Intervention acceptée</p>

            <div class="simu-suivi">
                <p class="simu-nom" data-titre>${e.nom} est en route vers votre adresse</p>
                <p class="simu-meta mono">${e.entreprise} · ${u} · ${e.prix} €</p>

                ${_()}

                <div class="simu-trajet">
                    <div class="simu-rail"><span data-rail></span></div>
                    <p class="simu-eta mono" data-eta>Arrivée estimée dans ${i} min</p>
                </div>

                <ol class="simu-jalons" data-jalons>
                    <li data-jalon="0">Offre acceptée</li>
                    <li data-jalon="1">En route</li>
                    <li data-jalon="2">Arrivé sur place</li>
                    <li data-jalon="3">Mission terminée</li>
                </ol>

                <p class="simu-paiement mono" data-paiement hidden>
                    ✓ Paiement de ${e.prix} € réglé dans l'application —
                    versement déclenché vers ${e.entreprise}
                </p>
            </div>`;let o=a.querySelector(`[data-rail]`),s=a.querySelector(`[data-eta]`),c=a.querySelector(`[data-titre]`),l=a.querySelectorAll(`[data-jalon]`),d=a.querySelector(`[data-route]`),f=a.querySelector(`[data-mobile]`);d.style.setProperty(`--long`,d.getTotalLength());let p=e=>l[e]&&l[e].classList.add(`fait`);if(p(0),!n){o.style.width=`100%`,d.classList.add(`roule`),f.style.offsetDistance=`100%`,[1,2,3].forEach(p),s.textContent=`Intervention réalisée en ${i} min`,c.textContent=`Intervention terminée`,a.querySelector(`[data-paiement]`).hidden=!1;return}await r(400),p(1);let m=8e3,h=Date.now();o.style.transition=`width ${m}ms linear`,o.style.width=`100%`,d.classList.add(`roule`),await new Promise(e=>{let t=null,n=setInterval(()=>{let r=Math.min((Date.now()-h)/m,1);f.style.offsetDistance=(r*100).toFixed(2)+`%`;let a=Math.ceil(i*(1-r));a!==t&&(t=a,s.textContent=a>0?`Arrivée estimée dans ${a} min`:`Le professionnel est arrivé`),r>=1&&(clearInterval(n),e())},60)}),p(2),c.textContent=`${e.nom} est arrivé sur place`,await r(900),p(3),c.textContent=`Intervention terminée`,s.textContent=`Intervention réalisée en ${i} min`,a.querySelector(`[data-paiement]`).hidden=!1}}var t=window.matchMedia(`(prefers-reduced-motion: no-preference)`).matches,n=document.getElementById(`burger`),r=document.getElementById(`menu`);if(n&&r){let e=e=>{n.setAttribute(`aria-expanded`,String(e)),r.classList.toggle(`ouvert`,e),document.body.style.overflow=e?`hidden`:``};n.addEventListener(`click`,()=>{e(n.getAttribute(`aria-expanded`)!==`true`)}),document.addEventListener(`keydown`,t=>{t.key===`Escape`&&n.getAttribute(`aria-expanded`)===`true`&&(e(!1),n.focus())}),r.querySelectorAll(`a`).forEach(t=>t.addEventListener(`click`,()=>e(!1))),window.matchMedia(`(min-width: 901px)`).addEventListener(`change`,t=>{t.matches&&e(!1)})}var i=document.getElementById(`jauge`);if(i){let e=()=>{let e=document.documentElement.scrollHeight-window.innerHeight;i.style.transform=`scaleX(${e>0?Math.min(window.scrollY/e,1):0})`};e(),window.addEventListener(`scroll`,e,{passive:!0}),window.addEventListener(`resize`,e)}var a=document.querySelectorAll(`[data-anime]`);if(a.length&&t&&`IntersectionObserver`in window){a.forEach(e=>e.classList.add(`avant`));let e=new IntersectionObserver(t=>{t.forEach(t=>{t.isIntersecting&&(t.target.classList.add(`vu`),e.unobserve(t.target))})},{rootMargin:`0px 0px -10% 0px`,threshold:.08});a.forEach(t=>e.observe(t))}var o=document.querySelectorAll(`[data-compteur]`);if(o.length&&t&&`IntersectionObserver`in window){let e=new IntersectionObserver(n=>{n.forEach(n=>{n.isIntersecting&&(t(n.target),e.unobserve(n.target))})},{threshold:.6});o.forEach(t=>e.observe(t));function t(e){let t=e.textContent,n=parseFloat(t.replace(/[^\d.,]/g,``).replace(`,`,`.`));if(!isFinite(n)||n===0)return;let r=t.slice(0,t.search(/[\d]/)),i=t.slice(t.search(/[\d]/)+String(n).replace(`.`,`,`).length),a=(t.match(/[.,](\d+)/)||[``,``])[1].length,o=performance.now();e.style.minWidth=e.getBoundingClientRect().width+`px`,e.style.display=`inline-block`;function s(c){let l=Math.min((c-o)/900,1),u=n*(1-(1-l)**3);e.textContent=r+u.toFixed(a).replace(`.`,`,`)+i,l<1?requestAnimationFrame(s):e.textContent=t}requestAnimationFrame(s)}}var s=document.getElementById(`nav-ref`),c=[...document.querySelectorAll(`.ref:not(.muette)`)];if(s&&c.length&&`IntersectionObserver`in window){let e=new Map;c.forEach((t,n)=>e.set(t,String(n+1).padStart(2,`0`)));let t=new Set,n=new IntersectionObserver(n=>{n.forEach(e=>e.isIntersecting?t.add(e.target):t.delete(e.target));let r=c.filter(e=>e.getBoundingClientRect().top<140),i=r[r.length-1];i?(s.textContent=`Réf. ${e.get(i)} — ${i.textContent.trim()}`,s.classList.add(`visible`)):s.classList.remove(`visible`)},{rootMargin:`-140px 0px 0px 0px`,threshold:[0,1]});c.forEach(e=>n.observe(e)),window.addEventListener(`scroll`,()=>n.takeRecords()&&null,{passive:!0});let r=!1;window.addEventListener(`scroll`,()=>{r||(r=!0,requestAnimationFrame(()=>{r=!1;let t=c.filter(e=>e.getBoundingClientRect().top<140),n=t[t.length-1];n?(s.textContent=`Réf. ${e.get(n)} — ${n.textContent.trim()}`,s.classList.add(`visible`)):s.classList.remove(`visible`)}))},{passive:!0})}var l=document.querySelector(`[data-filtre]`);if(l){let e=[...l.querySelectorAll(`.carte`)],t=document.createElement(`div`);t.className=`filtre`,t.innerHTML=`
        <label class="filtre-label mono" for="filtre-metier">Filtrer</label>
        <input type="search" id="filtre-metier" class="filtre-champ"
               placeholder="fuite, tableau électrique, porte claquée…"
               autocomplete="off">
        <span class="filtre-compte mono" data-compte></span>`,l.before(t);let n=t.querySelector(`input`),r=t.querySelector(`[data-compte]`),i=e=>e.normalize(`NFD`).replace(/[̀-ͯ]/g,``).toLowerCase(),a=t=>{r.textContent=t===e.length?`${t} services`:t===0?`aucun résultat`:`${t} sur ${e.length}`};a(e.length),n.addEventListener(`input`,()=>{let t=i(n.value.trim()),r=0;e.forEach(e=>{let n=!t||i(e.dataset.recherche||e.textContent).includes(t);e.hidden=!n,n&&r++}),l.classList.toggle(`vide`,r===0),a(r)})}document.querySelectorAll(`[data-onglets]`).forEach(e=>{let t=[...e.querySelectorAll(`[data-vue]`)];if(t.length<2)return;let n=document.createElement(`div`);n.className=`onglets`,n.setAttribute(`role`,`tablist`),t.forEach((e,i)=>{let a=document.createElement(`button`);a.type=`button`,a.className=`onglet`,a.textContent=e.dataset.vue,a.setAttribute(`role`,`tab`),a.setAttribute(`aria-selected`,String(i===0)),a.addEventListener(`click`,()=>r(i)),a.addEventListener(`keydown`,e=>{let a=e.key===`ArrowRight`?1:e.key===`ArrowLeft`?-1:0;if(!a)return;e.preventDefault();let o=(i+a+t.length)%t.length;r(o),n.children[o].focus()}),n.appendChild(a)}),e.classList.add(`avec-onglets`),e.prepend(n);function r(e){t.forEach((t,n)=>t.classList.toggle(`active`,n===e)),[...n.children].forEach((t,n)=>t.setAttribute(`aria-selected`,String(n===e)))}r(0)});var u=document.querySelector(`[data-compare]`);if(u&&t&&`IntersectionObserver`in window){let e=[...u.querySelectorAll(`.compare-ligne`)];e.forEach(e=>e.classList.add(`avant`));let t=new Map;e.forEach(e=>{let n=e.dataset.ligne;t.has(n)||t.set(n,[]),t.get(n).push(e)});let n=new IntersectionObserver(e=>{e.forEach(e=>{if(!e.isIntersecting)return;n.disconnect();let r=0;for(let e of t.values())e.forEach((e,t)=>{setTimeout(()=>{e.classList.remove(`avant`),e.classList.add(`vu`)},r*260+t*90)}),r++})},{threshold:.2});n.observe(u)}