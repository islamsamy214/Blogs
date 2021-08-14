<template>
  <div>
    <loading-ui v-if="pageLoading"></loading-ui>
    <table
      class="table table-striped table-responsive-sm table-responsive-md"
      v-else
    >
      <thead>
        <tr>
          <th scope="col">Image</th>
          <th scope="col">name</th>
          <th scope="col">email</th>
          <th scope="col">Handle</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="client in clients" :key="client.id">
          <td>
            <img
              :src="client.image_path"
              class="img-thumbnail"
              style="width: 40px; max-height: 40px"
            />
          </td>
          <td>{{ client.name }}</td>
          <td>{{ client.email }}</td>
          <td>
            <router-link
              class="btn btn-warning ml-1 mt-1"
              :to="{ name: 'admin.clients.edit', params: { id: client.id } }"
              >Edit</router-link
            >
            <button
              class="btn btn-danger ml-1 mt-1"
              @click="deleteClient(client.id)"
            >
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  props: ["clients", "pageLoading"],

  emits: ["clientDeleted"],
  
  methods: {
    deleteClient(id) {
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
              deleteClient(id);
            },
            { id: "yes", "data-status": "ok" }
          ),

          Noty.button("NO", "btn btn-error", function () {
            // console.log("button 2 clicked");
            deleteConfirmation.close();
          }),
        ],
      }).show(); //end of delete confirmation

      function deleteClient(id) {
        axios
          .delete(`/api/admin/clients/${id}`)
          .then((response) => {
            if (response.status == 200) {
              location.reload();
            }
          })
          .catch((error) => {
            console.log(error);
          }); //end of api req
      } // end of deleteclient func
    }, //end of deleteclient Method
  },
};
</script>