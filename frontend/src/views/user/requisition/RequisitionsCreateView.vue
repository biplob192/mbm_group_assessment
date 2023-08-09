<template>
  <div style="width: 70%; margin: auto; padding: 15px;"><h2>New Requisitions</h2></div>

  
  <div style="width: 70%; margin: auto; background: #fffae8; padding: 15px;">
    <form class="elements" v-on:submit.prevent="handleNewIssue">

      <div>
        <div style="float: left; width: 50%;">
          Requisition Name: <input name="requisition_name" v-model="requisition_name" class="form-control" type="text" style="width: 250px;" required/>
        </div>
        <div style="float: right; text-align: right; width: 50%;">
          <input type="button" value="Add New Item" class="add_new" @click="addRowItem" />
        </div>    
      </div>
      <br><br>

      <div style="margin-top: 10px; margin-bottom: 15px;">
        <table style="width: 100%;">
          <thead>
              <tr>
                  <th style="width: 33%; text-align: left;">Select Item</th>
                  <th style="width: 34%;">Quantity</th>
                  <th style="width: 33%; text-align: right;">Action</th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="(issued_item, index) in requisition_items" :key="index">
                  <td>
                    <input name="id" v-model="issued_item.id" class="form-control" type="hidden"/>

                      <select name="item" id="item" v-model="issued_item.id" style="width: 200px;" required>
                        <option value="" selected disabled>Select Item</option>
                        <option :value="item.id" v-for="item in items" :key="item.id">
                          {{ item.name }}
                        </option>
                      </select>
                  </td>
                  <td style="text-align: center;">
                    <input name="quantity" v-model="issued_item.quantity" class="form-control" type="text" required/>
                  </td>
                  <td style="text-align: right;">
                    <input
                        style="color: aliceblue; background-color: #e34545"
                        type="button"
                        value="Remove Item"
                        class="back-btn"
                        @click="deleteRowItem(index)"
                      />
                  </td>
              </tr>
          </tbody>
        </table>
      </div>


      <div style="margin-bottom: 30px;">
        <div style="float: left; width: 50%;">
        </div>
        <div style="float: right; text-align: right; width: 50%;">
          <button type="submit">Submit Requisition</button>
        </div>    
      </div>
    </form>  
</div>
<br>
</template>

<script>
import { mapState, mapActions } from "vuex";

export default {
  name: "RegisterView",
  components: {},
  data() {
    return {
      requisition_items: [{ id: "", quantity: "" }],
      requisition_name: "",
      userData: {
        item: "",
      },

      errors: {},
    };
  },

  computed: {
    ...mapState("item", ["items"]),
  },

  mounted() {
    this.getItems();
  },

  methods: {
    ...mapActions("item", ["getItems"]),
    ...mapActions("requisition", ["storeRequisition"]),
    ...mapActions("post", ["storePost"]),
    ...mapActions("post", ["getPosts"]),

    addRowItem: function () {
      this.requisition_items.push({ id: "", quantity: "" });
    },

    deleteRowItem(index) {
      this.requisition_items.splice(index, 1);
    },

    handlePost: async function () {
      let formData = new FormData();
      formData.append("title", this.postData.title);
      formData.append("body", this.postData.body);

      this.postData.title = "";
      this.postData.body = "";

      try {
        let info = await this.storePost(formData);
        let response = JSON.parse(info);

        if (response.status == 201) {
          this.getPosts();
          alert(response.data.message);
        }
      } catch (e) {
        alert(e.response.data.message);
      }
    },

    handleNewIssue: async function () {
      var requisition_items = JSON.stringify(this.requisition_items);
      
      let formData = new FormData();
      formData.append("requisition_name", this.requisition_name);
      formData.append("requisition_items", requisition_items);


      try {
        let info = await this.storeRequisition(formData);
        let response = JSON.parse(info);

        if (response.status == 201) {
          this.requisition_items = [{ id: "", quantity: "" }],
          this.requisition_name = "",
          alert(response.data.message);
        }
      } catch (e) {
        alert(e.response.data.data);
      }
    },
  },
};
</script>

<style scoped></style>
