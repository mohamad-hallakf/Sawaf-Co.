<template>
  <div>
    <PageNav pageName="Home Page"> </PageNav>
    <div class="m-5 shadow p-4">
      <center><h1>Welcome</h1></center>
      <p class="text-center">
        A Laravel single-page application that utilises Vue.js and Bootstrap to
        create a smooth, seamless user experience.
      </p>

      <h3>Features</h3>
      <div class="accordion" role="tablist">
        <b-card no-body class="mb-1">
          <b-card-header header-tag="header" class="p-1" role="tab">
            <b-button
              class="text-white"
              v-b-toggle.accordion-1
              variant="secondary"
              >Products</b-button
            >
          </b-card-header>
          <b-collapse
            id="accordion-1"
            visible
            accordion="my-accordion"
            role="tabpanel"
          >
            <b-card-body>
              <b-card-text>
                <b-row>
                  <b-col >
                    <h4>List</h4>
                    <p>
                      An elegantly styled table of the products registered in
                      the application.
                    </p>
                    <p>
                      The table uses Bootstrap table styling to display
                      alternating colours.
                    </p>
                  </b-col>

                </b-row>

                <b-row>
                  <b-col >
                    <h4>Create</h4>
                    <p>
                      An form that enables the user to add a product and specify
                      its price which is validated in the fornt and back end.
                    </p>
                    <p>
                      The form also allows the user to choose the owner of the
                      product from a list of companies.
                    </p>
                  </b-col>

                </b-row>

                <b-row>
                  <b-col >
                    <h4>Update</h4>
                    <p>
                      Allows the user to update an existing product using the
                      same form that they used to add it.
                    </p>
                    <p>
                      The form is pre-filled with the existing information which
                      gets updated upon being submitted and validated.
                    </p>
                  </b-col>

                </b-row>

                <b-row>
                  <b-col >
                    <h4>Delete</h4>
                    <p>
                      Allows the user to delete an existing product. The action
                      has a confirmation step to avoid accidental deletions.
                    </p>
                  </b-col>

                  <strong>All Opertion will return an alert on success</strong>
                </b-row>
              </b-card-text>
            </b-card-body>
          </b-collapse>
        </b-card>

        <b-card no-body class="mb-1">
          <b-card-header header-tag="header" class="p-1" role="tab">
            <b-button
              class="text-white"
              v-b-toggle.accordion-2
              variant="secondary"
              >Orders</b-button
            >
          </b-card-header>
          <b-collapse id="accordion-2" accordion="my-accordion" role="tabpanel">
            <b-card-body>
              <b-card-text>
                <b-row>
                  <b-col >
                    <h4>List</h4>
                    <p>
                      An elegantly styled table of the orders registered in the
                      application.
                    </p>
                    <p>
                      The table uses Bootstrap table styling to display
                      alternating colours.
                    </p>
                  </b-col>

                </b-row>

                <b-row>
                  <b-col >
                    <h4>Create</h4>
                    <p>
                      An form that enables the user to add a orders and specify
                      its attributes
                    </p>
                    <p>
                      The form also allows the user to add items in this order
                      by add button
                    </p>
                    <p>
                      the user can add records that contain number of items
                      equal to the number of products
                    </p>
                    <p>
                      the user can remove the records but should stay one record
                      at least
                    </p>
                    <p>
                      whan the user select item the price input will fill by the
                      defualt value and the user can update it
                    </p>
                    <p>
                      when the user add tow records and try to choose the same
                      item he will have a warning alert
                    </p>
                  </b-col>

                </b-row>

                <b-row>
                  <b-col >
                    <h4>Update</h4>
                    <p>
                      Allows the user to update an existing order and update
                      (add , remove , edit) the items that belong to
                    </p>
                    <p>
                      when the user try to delete all items he will have a warning alert
                    </p>
                  </b-col>

                </b-row>

                <b-row>
                  <b-col >
                    <h4>Delete</h4>
                    <p>
                      Allows the user to delete an existing product. The action
                      has a confirmation step to avoid accidental deletions.
                    </p>
                  </b-col>

                  <strong>All Opertion will return an alert on success</strong>
                </b-row>
              </b-card-text>
            </b-card-body>
          </b-collapse>
        </b-card>


      </div>
    </div>
  </div>
</template>

<script>
import PageNav from "../components/PageNav.vue";

export default {
  components: { PageNav },
  name: "HomeView",
};
</script>
