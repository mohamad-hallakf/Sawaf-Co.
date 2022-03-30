<template>
  <b-row align-h="center" class="mx-auto">
    <b-form class="col-8" @submit="onSubmit">
      <b-row>
        <h4 v-if="action == `update`" class="text-secondary">Update Order</h4>
        <h4 v-else class="text-secondary">Create Order</h4>

        <label for="customer-id" />Choose Customer Name
        <select
          class="form-select"
          id="customer-id"
          v-model="order.customer_id"
          required
        >
          <option value="" disabled>-- Please select an option --</option>

          <option v-for="op in options" :key="op.id" :value="op.id">
            {{ op.firstname + " " + op.lastname }}
          </option>
        </select>
      </b-row>

      <b-row class="mt-3">
        <b-form-group label="Order number & Date" label-for="order-number">
          <b-row>
            <b-col cols="6">
              <b-form-input
                id="order-number"
                type="number"
                placeholder="Order Number"
                required
                v-model="order.ordernumber"
              ></b-form-input>
            </b-col>
            <b-col cols="6">
              <b-form-datepicker
                id="order-date"
                v-model="order.orderdate"
                class="mb-2"
              ></b-form-datepicker>
            </b-col>
          </b-row>
        </b-form-group>
      </b-row>

      <b-row class="mt-3">
        <span
          v-if="action == `create`"
          class="mx-auto text-center font-weight-bold h4"
        >
          Add Items
          <b-button @click="insert" variant="success" class="p-1 rounded">
            <b-icon icon="plus-circle" class="mt-1"></b-icon></b-button
        ></span>
        <b-row>
          <b-form-group label-for="order-number">
            <TransitionGroup tag="div" name="fade" class="container">
              <div v-for="(item, ind) in items" class="mb-2" :key="ind">
                <b-row class="max-auto">
                  <b-col cols="4">
                    <select
                      @change="changeProduct(productid[ind], $event)"
                      class="form-select"
                      v-model="productid[ind]"
                      required
                      :data-id="`product-` + ind"
                    >
                      <option value="" disabled selected>
                        -- Please select an item --
                      </option>

                      <option v-for="op in product" :key="op.id" :value="op.id">
                        {{ op.productname }}
                      </option>
                    </select>
                  </b-col>
                  <b-col cols="4">
                    <b-form-input
                      type="number"
                      placeholder="Price"
                      required
                      :data-id="`price-` + ind"
                      v-model="price[ind]"
                    ></b-form-input>
                  </b-col>
                  <b-col cols="3">
                    <b-form-input
                      type="number"
                      placeholder="Quantity"
                      required
                      v-model="quantity[ind]"
                    ></b-form-input>
                  </b-col>

                  <b-col v-if="action == `create`" cols="1">
                    <b-button
                      v-if="ind != 0"
                      variant="danger"
                      class="p-1 rounded"
                      @click="remove(item)"
                    >
                      <b-icon icon="trash-fill" class="mt-1"></b-icon
                    ></b-button>
                  </b-col>
                  <b-col v-else>
                    <b-button
                      variant="danger"
                      class="p-1 rounded"
                      @click="remove(item)"
                    >
                      <b-icon icon="trash-fill" class="mt-1"></b-icon
                    ></b-button>
                  </b-col>
                </b-row>
              </div>
            </TransitionGroup>
          </b-form-group>
        </b-row>
      </b-row>

      <b-row align-h="center" class="mt-4">
        <b-button variant="primary" type="submit" class="px-5 mx-auto w-50"
          >Save</b-button
        >
      </b-row>
    </b-form>
    <warnning-modal :show="showModal" @close="showModal = false">
      <template #header>
        <h3 class="text-warning mx-auto">Warning !</h3>
      </template>
      <template #body>
        <h5 class="text-dark">you must add one item at least</h5>
      </template>
    </warnning-modal>
  </b-row>
</template>

<script>
import axios from "axios";
import WarnningModal from "./WarnningModal.vue";
export default {
  components: { WarnningModal },
  props: ["action"],
  created() {
    axios
      .get("/api/order/getAllCustomers")
      .then((response) => {
        this.options = response.data.data;
      })
      .catch((error) => {
        console.log(error);
      });

    axios
      .get("/api/product")
      .then((response) => {
        this.product = response.data.data;
      })
      .catch((error) => {
        console.log(error);
      });
    if (this.action == "update") {
      axios
        .post("/api/order/edit/" + this.$route.params.id + "")
        .then((response) => {
          let orders = response.data.data;
          console.log(orders)
          this.order.ordernumber = orders.ordernumber;
          this.order.orderdate = orders.orderdate;
          this.order.customer_id = orders.customer_id;
          this.items = [];
          for (var i = 0; i < orders.items.length; i++) {
            this.items.push(i);
            this.price[i] = orders.items[i].pivot.unitprice;;
            this.quantity[i] = orders.items[i].pivot.quantity;
            this.productid[i] = orders.items[i].id;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }
  },

  data() {
    return {
      items: [1],
      order: {
        ordernumber: "",
        orderdate: "",
        customer_id: "",
      },
      showModal: false,
      options: [],
      product: [],
      price: [],
      quantity: [],
      productid: [""],
    };
  },
  methods: {
    onSubmit(event) {
      event.preventDefault();
      let action = this.action;
      if (this.action == "update") {
        axios
          .post("/api/order/update/" + this.$route.params.id + "", {
            order: this.order,
            quantity: this.quantity,
            price: this.price,
            productid: this.productid,
          })
          .then((response) => {
            if (response.data.response) {
              this.$emit("showSuccessAlert");
              this.resetForm();
            }
          })
          .catch((error) => {
            console.log(error);
          });
      } else
        axios
          .post("/api/order/store", {
            order: this.order,
            quantity: this.quantity,
            price: this.price,
            productid: this.productid,
          })
          .then((response) => {
            if (response.data.response) {
              this.$emit("showSuccessAlert");
              this.resetForm();
            }
          })
          .catch((error) => {
            console.log(error);
          });
    },
    resetForm() {
      if (this.action == "create") {
        this.order.ordernumber = "";
        this.order.orderdate = "";
        this.order.customer_id = "";
        this.items = [1];
        this.price = [];
        this.quantity = [];
        this.productid = [""];
      } else {
        setTimeout(() => {
          this.$router.push({ path: "/order" });
        }, 9000);
      }
    },

    remove(item) {
      const i = this.items.indexOf(item);
      if (i > -1 && this.items.length > 1) {
        this.items.splice(i, 1);
        this.quantity.splice(i, 1);
        this.price.splice(i, 1);
        this.productid.splice(i, 1);
      } else if ((this.items.length = 1)) {
        this.showModal = true;
      }
    },
    insert() {
      this.items.push(1);
    },
    changeProduct(id, e) {
      let target = e.target.getAttribute("data-id").split("-");
      let index = target[1];
      let price;
      this.product.forEach((element) => {
        if (element.id == id) price = element.unitprice;
      });
      this.price[index] = price;
    },
  },
};
</script>
<style scoped>
.fade-move,
.fade-enter-active,
.fade-leave-active {
  transition: all 0.5s cubic-bezier(0.55, 0, 0.1, 1);
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: scaleY(0.01) translate(30px, 0);
}

.fade-leave-active {
  position: absolute;
}
</style>
