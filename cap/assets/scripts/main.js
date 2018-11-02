/* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
particlesJS.load('particles-js', 'assets/particles-config/particlesjs-config.json', function() {
    console.log('particles.js config loaded');
});

var nav_labels = document.querySelectorAll('.nav-label');
var form_tabs = document.querySelectorAll('.form-tab');

var nav_login_label = nav_labels[0];
var nav_register_label = nav_labels[1];

var form_login_tab = form_tabs[0];
var form_register_tab = form_tabs[1];

var nav_underlay = document.querySelector("#nav-item-underlay");

function toggleForms() {
    var label_id = this.getAttribute('data-label-id');
    if (label_id === "1" && !nav_login_label.classList.contains('nav-label-active') && !form_login_tab.classList.contains('tab-active')) {
        nav_underlay.style.left = '0px';
        nav_underlay.style.width = '42px';
        form_login_tab.classList.add('tab-active');
        form_register_tab.classList.remove('tab-active');
        nav_login_label.classList.add('nav-label-active');
        nav_register_label.classList.remove('nav-label-active');
    } else if (label_id === "2" && !nav_register_label.classList.contains('nav-label-active') && !form_register_tab.classList.contains('tab-active')) {
        nav_underlay.style.left = '70px';
        nav_underlay.style.width = '67px';
        form_login_tab.classList.remove('tab-active');
        form_register_tab.classList.add('tab-active');
        nav_login_label.classList.remove('nav-label-active');
        nav_register_label.classList.add('nav-label-active');
    }
}

nav_login_label.onclick = toggleForms;
nav_register_label.onclick = toggleForms;

form_inputs = document.querySelectorAll('.form-input');

for (var i = 0; i < form_inputs.length; i++) {
    form_inputs[i].addEventListener('focus', transformInputFocusIn);
    form_inputs[i].addEventListener('focusout', transformInputFocusOut);
}

function transformInputFocusIn() {
    var label = findLabel(this);
    moveLabelUp(label);
}

function transformInputFocusOut() {
    var label = findLabel(this);
    if (this.value === "") {
        moveLabelDown(label);
    } else {
        label.style.color = "rgba(0, 0, 0, .26)";
    }
}

function findLabel(input) {
    var next = input;
    for (var i = 0; i < 4; i++) {
        next = next.nextSibling;
    }
    return next;
}

function moveLabelUp(label) {
    label.style.top = "1.2rem";
    label.style.fontSize = "0.8rem";
    label.style.color = "#1976d2";
}

function moveLabelDown(label) {
    label.style.top = "3.2rem";
    label.style.fontSize = "1rem";
    label.style.color = "rgba(0, 0, 0, .26)";
}