<template>
  <div><h2>Requisition List</h2></div>

  <div>
    <li v-for="requisition in requisitions" :key="requisition.id">
      <span style="font-size: 1.5rem">{{ requisition.name }} </span>

      <span style="margin-left: 10px">
        <button v-if="requisition.is_approved == null && user_role == 'Admin'" @click="handleApproveClick(requisition)">Approve</button> <button v-if="requisition.is_approved == null && user_role == 'Admin'" @click="handleRejectClick(requisition)">Reject</button>
        <button v-if="user_role == 'Store_Executive'" @click="handleIssueRequisitionClick(requisition)">Issue Requisition</button> <button v-if="requisition.is_approved == 1" disabled>Approved</button>
        <button v-if="requisition.is_approved == 0" disabled>Rejected</button>
      </span>
    </li>
  </div>
</template>

<script>
import { mapState, mapGetters, mapActions } from "vuex";

export default {
  data() {
    return {};
  },

  computed: {
    // Import states
    ...mapState("requisition", ["requisitions"]),

    // Import getters
    ...mapGetters({
      logged_in: "loginStatus",
      user_role: "userRole",
    }),
  },

  mounted() {
    if (this.logged_in) {
      this.getRequisitions();
    }
  },

  methods: {
    ...mapActions("requisition", ["getRequisitions", "approveRequisition", "rejectRequisition", "issueRequisition"]),

    handleApproveClick(requisition) {
      this.approveRequisition(requisition.id);
      this.getRequisitions();
    },

    handleRejectClick(requisition) {
      this.rejectRequisition(requisition.id);
      this.getRequisitions();
    },

    handleIssueRequisitionClick: async function (requisition)  {
      let formData = new FormData();
      formData.append("requisition_id", requisition.id);

      try {
        let info = await this.issueRequisition(formData);
        let response = JSON.parse(info);

        if (response.status == 201) {
          alert(response.data.message);
          this.getRequisitions();
        }
      } catch (e) {
        alert(e.response.data.message);
      }
    },
  },
};
</script>

<style scoped>
.answer {
  font-weight: bold;
  color: orangered;
}

a:hover {
  color: orangered;
  text-decoration: underline;
}

a {
  display: inline-block;
  font-size: 14px;
  text-decoration: none;
  /* padding: 5px;
  margin: 5px; */
  border-left: 1px solid var(--color-border);
}

.post_title {
  font-size: 21px;
  text-decoration: none;
  margin: 5px;
  cursor: pointer;
}

.post_title:hover {
  color: orangered;
  text-decoration: underline;
}
</style>
