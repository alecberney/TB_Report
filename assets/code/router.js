[...]

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    component: () => import("./views/app"),
    redirect: "/user-jobs",
    children: [
      {
        path: "user-jobs",
        name: "user-jobs",
        component: () => import("./views/app/userJobs/UserJobs"),
      },
      {
        path: "unassigned-jobs",
        component: () => import("./views/app/unassignedJobs/UnassignedJobs"),
        beforeEnter: (to, from, next) => {
          next((store.getters.userIsWorker
            || store.getters.userIsAdmin) ? {} : '/');
        }
      },
      {
        path: "job-categories",
        component: () => import("./views/app/jobCategories/JobCategories"),
      },
      {
        path: "settings",
        component: () => import("./views/app/settings/Settings"),
      },
    ]
  },
  {
    path: "*",
    component: () => import("./views/Error")
  }
];

const router = new VueRouter({
  linkActiveClass: "active",
  routes,
  mode: "history"
});

export default router;
