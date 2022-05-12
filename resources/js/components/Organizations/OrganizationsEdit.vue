<template>
  <div class="mt-5" v-if="org">
    <h4>Edit Organization</h4>
    <div class="row">
      <div class="col-md-3">
        <div class="form-group mb-3">
          <span class="error-message" for="name" v-if="error_message">{{
            error_message.name
          }}</span>
          <input
            type="text"
            class="form-control"
            id="name"
            placeholder="Company Name"
            required
            v-model="org.name"
            name="name"
          />
        </div>
        <div class="form-gorup mb-3">
          <span class="error-message" for="address1" v-if="error_message">{{
            error_message.address1
          }}</span>
          <input
            type="text"
            class="form-control"
            placeholder="Address 1"
            required
            v-model="org.address1"
            name="address1"
          />
        </div>
        <div class="form-gorup mb-3">
          <span class="error-message" for="address2" v-if="error_message">{{
            error_message.address2
          }}</span>
          <input
            type="text"
            class="form-control"
            placeholder="Address 2"
            required
            v-model="org.address2"
            name="address2"
          />
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-gorup mb-3">
              <span class="error-message" for="city" v-if="error_message">{{
                error_message.city
              }}</span>
              <input
                type="text"
                class="form-control"
                placeholder="City"
                required
                v-model="org.city"
                name="city"
              />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-gorup mb-3">
              <span class="error-message" for="state" v-if="error_message">{{
                error_message.state
              }}</span>
              <input
                type="text"
                class="form-control"
                placeholder="State"
                required
                v-model="org.state"
                name="state"
              />
            </div>
          </div>
        </div>

        <div class="form-gorup mb-3">
          <span class="error-message" for="postal_code" v-if="error_message">{{
            error_message.postal_code
          }}</span>
          <input
            type="text"
            class="form-control"
            placeholder="Postal Code"
            required
            v-model="org.postal_code"
            name="postal_code"
          />
        </div>

        <div class="form-gorup mb-3">
          <span class="error-message" for="url" v-if="error_message">{{
            error_message.url
          }}</span>
          <input
            type="text"
            class="form-control"
            placeholder="Company URL"
            required
            v-model="org.url"
            name="url"
          />
        </div>

        <div class="form-gorup mb-3">
          <span
            class="error-message"
            for="partner_type"
            v-if="error_message"
            >{{ error_message.partner_type }}</span
          >
          <select
            class="form-control"
            required
            id="partner_type"
            v-model="org.partner_type"
          >
            <option selected disabled>Customer Type</option>
            <option value="Partner">Partners</option>
            <option value="Integrator">System Integrators</option>
            <option value="Customer">End Customers</option>
          </select>
        </div>

        <div class="form-gorup mb-3">
          <span
            class="error-message"
            for="partner_id"
            v-if="error_message"
            >{{ error_message.partner_id }}</span
          >
          <select
            class="form-control"
            required
            id="partner_id"
            v-model="org.partner_id"
          >
            <option value="" disabled selected>Choose Partner</option>
            <option v-for="partner in partners" :key="partner.id" :value="partner.id">{{partner.name}}</option>
          </select>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group mb-3">
          <span
            class="error-message"
            for="contact_technical_name"
            v-if="error_message"
            >{{ error_message.contact_technical_name }}</span
          >
          <input
            type="text"
            class="form-control"
            placeholder="Technical Contact Name"
            id="contact_technical_name"
            required
            v-model="org.contact_technical_name"
            name="contact_technical_name"
          />
        </div>

        <div class="form-group mb-3">
          <span
            class="error-message"
            for="contact_technical_email"
            v-if="error_message"
            >{{ error_message.contact_technical_email }}</span
          >
          <input
            type="text"
            class="form-control"
            placeholder="Technical Contact Email"
            id="contact_technical_email"
            required
            v-model="org.contact_technical_email"
            name="contact_technical_email"
          />
        </div>

        <div class="form-group mb-3">
          <span
            class="error-message"
            for="contact_technical_phone"
            v-if="error_message"
            >{{ error_message.contact_technical_phone }}</span
          >
          <input
            type="text"
            class="form-control"
            placeholder="Technical Contact Phone"
            id="contact_technical_phone"
            required
            v-model="org.contact_technical_phone"
            name="contact_technical_phone"
          />
        </div>

        <div class="form-group mb-3" style="height: 37px;"></div>

        <div class="form-group mb-3">
          <span
            class="error-message"
            for="contact_commercial_name"
            v-if="error_message"
            >{{ error_message.contact_commercial_name }}</span
          >
          <input
            type="text"
            class="form-control"
            placeholder="Commercial Contact Name"
            id="contact_commercial_name"
            required
            v-model="org.contact_commercial_name"
            name="contact_commercial_name"
          />
        </div>

        <div class="form-group mb-3">
          <span
            class="error-message"
            for="contact_commercial_email"
            v-if="error_message"
            >{{ error_message.contact_commercial_email }}</span
          >
          <input
            type="text"
            class="form-control"
            placeholder="Commercial Contact Email"
            id="contact_commercial_email"
            required
            v-model="org.contact_commercial_email"
            name="contact_commercial_email"
          />
        </div>

        <div class="form-group mb-3">
          <span
            class="error-message"
            for="contact_commercial_phone"
            v-if="error_message"
            >{{ error_message.contact_commercial_phone }}</span
          >
          <input
            type="text"
            class="form-control"
            placeholder="Commercial Contact Phone"
            id="contact_commercial_phone"
            required
            v-model="org.contact_commercial_phone"
            name="contact_commercial_phone"
          />
        </div>
      </div>
      <div class="col-md-12 mt-2">
        <p class="error-message" v-if="error_message">
          {{ error_message_global }}
        </p>
      </div>
      <div class="col-md-12">
        <button class="btn btn-danger mr-2" @click="deleteOrg">
          Delete
        </button>
        &nbsp;
        <button type="submit" class="btn btn-success" @click="updateOrg">
          Update
        </button>
        &nbsp;
        <router-link :to="'/organizations'" class="btn btn-outline-secondary">
          Back
        </router-link>
        <p>{{ message }}</p>
      </div>
    </div>
  </div>
  <div class="mt-5" v-else>
    <br />
    <p>Please click on a Organization...</p>
  </div>
</template>
<script>
import OrganizationService from "../../services/OrganizationService";
import {reactive, onMounted, ref} from "vue";
export default {
  data() {
    return {
      org: null,
      message: "",
      error_message: "",
      error_message_global: "",
      partners : reactive([]),
    };
  },
  created() {
    OrganizationService.getAll()
      .then(response => {
        if (response.status = "Success") {
          this.partners = response.data;
        }
      })
      .catch(e => {
        console.log(e);
      });
  },
  methods: {
    getOrg(id) {
      OrganizationService.get(id)
        .then((response) => {
          this.org = response.data;
          // console.log("=====", response.data);
          if (this.org.contacts.length>0) {
            this.org.contacts.map((contact)=> {
              if(contact.type === "Technical") {
                this.org.contact_technical_name = contact.name;
                this.org.contact_technical_email = contact.email;
                this.org.contact_technical_phone = contact.phone;
                this.org.contact_technical_id = contact.id
              } else if (contact.type === "Commercial") {
                this.org.contact_commercial_name = contact.name;
                this.org.contact_commercial_email = contact.email;
                this.org.contact_commercial_phone = contact.phone;
                this.org.contact_commercial_id = contact.id
              }
            })
          }
        })
        .catch((e) => {
          console.log("error", e);
        });
    },

    updateOrg() {
      OrganizationService.update(this.org.id, this.org)
        .then((response) => {
          this.message = "The organization was successfully updated!";
          this.error_message = "";
          this.$router.push({name: "Organizations-List"});
        })
        .catch((e) => {
          this.error_message = e.response.data.message;
          if (typeof this.error_message === "string" || this.error_message instanceof String){
            this.error_message_global = this.error_message;
          }
        });
    },
    deleteOrg() {
      OrganizationService.delete(this.org.id)
        .then((response) => {
          console.log(response.data);
          this.$router.push({ name: "Organizations-List" });
        })
        .catch((e) => {
          this.error_message = e.response.data.message;
          this.error_message_global = e.response.data.message;
        });
    },
  },
  mounted() {
    this.message = "";
    this.getOrg(this.$route.params.id);
  },
};
</script>
<style></style>
