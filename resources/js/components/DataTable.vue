<template>
  <div>
    <b-row>
      <b-alert v-model="showSuccessAlert" variant="success" show  dismissible>
        {{ alertMessage }}
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
            <template #cell(product_name)="data">
              {{ `${data.item.productname} ` }}
            </template>
            <template #cell(supplier_id)="data">
              {{ `${data.item.suppliers.companyname} ` }}
            </template>
            <template #cell(unit_price)="data">
              {{ `${data.item.unitprice} ` }}
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

    <!-- Delete Customer Modal -->
    <b-modal
      ref="delete-product-modal"
      size="md"
      hide-footer
      title="Confirm Deletion"
    >
      <delete-product-modal
        @closeDeleteModal="closeDeleteModal"
        @reloadDataTable="getCustomerData"
        @showDeleteAlert="showDeleteSuccessModal"
        :productId="productId"
      ></delete-product-modal>
    </b-modal>
  </div>
</template>

<script>
import axios from "axios";
import DeleteCustomerModal from "./DeleteModal.vue";

export default {
  components: {
    DeleteCustomerModal,
  },
  data() {
    return {
      fields: [
        {
          key: "product_name",
          label: "Product Name",
          sortable: false,
        },
        {
          key: "supplier_id",
          label: "Company Name",
          sortable: false,
        },
        {
          key: "unit_price",
          label: "Unit Price",
          sortable: false,
        },

        "actions",
      ],
      items: [],
      numberOfCustomers: 0,
      productId: 0,
      companySearchTerm: "",
      showSuccessAlert: false,
      alertMessage: "",
    };
  },
  mounted() {
    this.getCustomerData();
  },
  methods: {
    showCreateModal() {
      this.$refs["create-product-modal"].show();
    },
    closeCreateModal() {
      this.$refs["create-product-modal"].hide();
    },
    getCustomerData() {
      axios
        .get("/api/product/")
        .then((response) => {
          this.items = response.data.data;
          this.numberOfCustomers = response.data.data.length;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    goToUpdatePage(id) {
       this.$router.push({ path: "/update-product/"+id+"" });
    },
    closeEditModal() {
      this.$refs["edit-product-modal"].hide();
    },
    setFilterTotalIsActive() {
      this.tableHeader = "Total Customers";
      this.getCustomerData();
    },
    setFilterActiveIsActive() {
      this.tableHeader = "Active Customers";
      this.items = this.activeCustomersData;
    },
    showAlertCreate() {
      this.showSuccessAlert = true;
      this.alertMessage = "Customer was created successfully!";
    },
    showAlertUpdate() {
      this.showSuccessAlert = true;
      this.alertMessage = "Customer was updated successfully";
    },
    showDeleteModal(id) {
      this.$refs["delete-product-modal"].show();
      this.productId = id;
    },
    closeDeleteModal() {
      this.$refs["delete-product-modal"].hide();
    },
    showDeleteSuccessModal() {
      this.showSuccessAlert = true;
      this.alertMessage = "Customer was deleted successfully!";
    },
  },
};
</script>

<style>
</style>
