import RequisitionsIndex from "../../views/user/requisition/RequisitionsIndexView.vue";
import RequisitionsCreate from "../../views/user/requisition/RequisitionsCreateView.vue";
import RequisitionsEdit from "../../views/user/requisition/RequisitionsEditView.vue";
import RequisitionsShow from "../../views/user/requisition/RequisitionsShowView.vue";

export default [
  {
    path: "/requisitions",
    name: "RequisitionsIndex",
    component: RequisitionsIndex,
  },

  {
    path: "/requisitions/create",
    name: "RequisitionsCreate",
    component: RequisitionsCreate,
  },

  {
    path: "/requisitions/:id",
    name: "RequisitionsShow",
    component: RequisitionsShow,
  },

  {
    path: "/requisitions/:id/edit",
    name: "RequisitionsEdit",
    component: RequisitionsEdit,
  },
];
