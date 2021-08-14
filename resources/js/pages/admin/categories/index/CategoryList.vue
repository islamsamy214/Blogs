<template>
  <div>
    <loading-ui v-if="pageLoading"></loading-ui>
    <table
      class="table table-striped table-responsive-sm table-responsive-md"
      v-else
    >
      <thead>
        <tr>
          <th scope="col">name</th>
          <th scope="col">posts</th>
          <th scope="col">Handle</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="category in categories" :key="category.id">
          <td>{{ category.name }}</td>
          <td>{{ category.posts_count }}</td>
          <td>
            <router-link
              class="btn btn-warning ml-1 mt-1"
              :to="{
                name: 'admin.categories.edit',
                params: { id: category.id },
              }"
              >Edit</router-link
            >
            <button
              class="btn btn-danger ml-1 mt-1"
              @click="deleteCategory(category.id)"
            >
              Delete
            </button>
            <router-link
              class="btn btn-primary ml-1 mt-1"
              :to="{ name: 'admin.posts', params: { categoryId: category.id } }"
              >Show Posts</router-link
            >
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  props: ["categories", "pageLoading"],

  emits: ["categoryDeleted"],

  methods: {
    deleteCategory(id) {
      var deleteConfirmation = new Noty({
        layout: "center",
        killer: true,
        progressBar: false,
        modal: true,
        text: "Confirm Delete ?",
        buttons: [
          Noty.button(
            "YES",
            "btn btn-danger",
            function () {
              deleteCategory(id);
            },
            { id: "yes", "data-status": "ok" }
          ),

          Noty.button("NO", "btn btn-error", function () {
            // console.log("button 2 clicked");
            deleteConfirmation.close();
          }),
        ],
      }).show(); //end of delete confirmation

      function deleteCategory(id) {
        axios
          .delete(`/api/admin/categories/${id}`)
          .then((response) => {
            if (response.status == 200) {
              location.reload();
            }
          })
          .catch((error) => {
            console.log(error);
          }); //end of api req
      } // end of deletecategory func
    }, //end of deletecategory Method
  },
};
</script>