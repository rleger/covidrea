window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',

    data() {
        return {
            open: false,
        }
    }
});

if (document.querySelector("#emails.paste-enabled")) {
    document.querySelector("#emails.paste-enabled").addEventListener('paste', (event) => {

        // removes unnecessary text
        let formatEmails = (list) => {
            return list.replace(/[;,]/g, " ").split(" ").map(email => {
                if(email.includes("@")) {
                  try {
                    return email.match(/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/g)[0];
                } catch(e) {
                    // silent
                }
              }
              return undefined;
            }).filter(s => s != undefined).join(", ");
        }
        let paste = (event.clipboardData || window.clipboardData).getData('text');

        let emails = paste;

        // try formating
        try {
            emails = formatEmails(paste);
        } catch (e) {
            // silent, error. let the original text be pasted
        }
        let textarea = event.srcElement;
        let contentPresent = !!(textarea.value.trim());

        textarea.value = (contentPresent ? textarea.value + ", " : "") + emails;
        event.preventDefault();
    });
}
