[...]

const KEYCLOAK_ON_LOAD = 'login-required';

Vue.$keycloak
  .init({
    onLoad: `${KEYCLOAK_ON_LOAD}`,
    checkLoginIframeInterval: 600, // Every 10 min
  })
  .then(() => {
    new Vue({
      i18n,
      store,
      router,
      vuetify: new Vuetify({
        lang: {
          locales: { fr },
          current: 'fr',
        }
      }),
      render: h => h(App),
    }).$mount('#app');
    window.onfocus = () => {
      updateToken();
    };
  });