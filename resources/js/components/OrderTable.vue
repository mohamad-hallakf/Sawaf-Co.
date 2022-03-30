<template>
  <div>
    <b-row>
        <b-alert v-model="showSuccessAlert" variant="success"  dismissible  class="px-5">
           <h5  >
 {{ alertMessage }}
          </h5>
      </b-alert>
    </b-row>
    <b-row class="mt-3">
      <b-card>
        <b-row class="mt-3">
          <b-table
            striped
            hover
            :items="items"
            :fields="fields"
            class="text-center"
          >


            <template #cell(order-number)="data">
              {{ `${data.item.ordernumber} ` }}
            </template>
                <template #cell(customer_id)="data">
              {{ `${data.item.customers.firstname} `+' '+`${data.item.customers.lastname} ` }}
            </template>
    <template #cell(order-date)="data">
              {{ `${data.item.orderdate} ` }}
            </template>
              <template #cell(total-amount)="data">
              {{ `${data.item.totalamount} ` }}
            </template>
            <template #cell(actions)="data">
              <b-row>
                <b-col >
                  <b-button
                    variant="outline-primary"
                    @click="goToUpdatePage(data.item.id)"
                  >
                    Modifay</b-button
                  >
                               <b-button
                    variant="outline-danger"
                                 @click="showDeleteModal(data.item.id)"
                  >
                    Delete</b-button
                  >
                </b-col>

              </b-row>
            </template>
          </b-table>
        </b-row>
      </b-card>
    </b-row>

    <!-- Delete Order Modal -->
    <b-modal
      ref="delete-order-modal"
      size="md"
      hide-footer
      title="Confirm Deletion"
    >
      <DeleteOrderModal
        @closeDeleteModal="closeDeleteModal"
        @reloadDataTable="getOrderData"
        @showDeleteAlert="showDeleteSuccessModal"
        :itemId="orderId"
        itemType="order"
      ></DeleteOrderModal>
    </b-modal>
  </div>
</template>

<script>
import axios from "axios";
import DeleteOrderModal from "./DeleteModal.vue";

export default {

  components: {
    DeleteOrderModal,
  },
  data() {
    return {
      fields: [


        {
          key: "order-number",
          label: "Order Number",
          sortable: false,
        },

   {
          key: "customer_id",
          label: "Customer Name",
          sortable: false,
        },
            {
          key: "order-date",
          label: "Order Date",
          sortable: false,
        },
           {
          key: "total-amount",
          label: "Total",
          sortable: false,
        },

        "actions",
      ],
      items: [],
      numberOfOrders: 0,
      orderId: 0,
      companySearchTerm: "",
      showSuccessAlert: false,
      alertMessage: "",
    };
  },
  mounted() {
    this.getOrderData();
  },
  methods: {
    getOrderData() {
      axios
        .get("/api/order/")
        .then((response) => {
          this.items = response.data.data;
          this.numberOfOrders = response.data.data.length;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    goToUpdatePage(id) {
       this.$router.push({ path: "/update-order/"+id+"" });
    },

    showDeleteModal(id) {
      this.$refs["delete-order-modal"].show();
      this.orderId = id;
    },
    closeDeleteModal() {
      this.$refs["delete-order-modal"].hide();
    },
    showDeleteSuccessModal() {
      this.showSuccessAlert = true;
      this.alertMessage = "Order was deleted successfully!";
    },
  },
};
</script>

<style>
</style>
