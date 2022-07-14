const clickOutside = {
    mounted(el, binding) {
        el.clickOutsideEvent = function (event) {
            if (!(el == event.target || el.contains(event.target))) {
                binding.value(event);
            }
        };
        document.body.addEventListener("click", el.clickOutsideEvent);
    },
    unmounted(el) {
        document.body.removeEventListener("click", el.clickOutsideEvent);
    },
};

export default clickOutside;
