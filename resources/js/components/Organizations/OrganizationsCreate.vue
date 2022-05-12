<template>
  <div v-if="!submitted">
    <div class="row">
      <div class="col-md-4 mt-5">
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
            id="address1"
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
            id="address2"
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
                id="city"
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
            id="postal_code"
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
            id="url"
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
            <option value="" disabled selected>Customer Type</option>
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

      <div class="col-md-4 mt-5">
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
        <button @click="save" class="btn btn-success me-4">Submit</button>
        <router-link :to="'/organizations'" class="btn btn-outline-secondary">
          Back
        </router-link>
      </div>
      
    </div>
  </div>
  <div v-else class="mt-5">
    <h4>You submitted successfully!</h4>
    <button class="btn btn-success" @click="newOrg">Add</button>
    <router-link :to="'/organizations'" class="btn btn-outline-secondary ms-4">
      Back
    </router-link>
  </div>
</template>

<script>
import OrganizationService from "../../services/OrganizationService";
import {reactive, onMounted, ref} from "vue";
export default {
  data() {
    return {
      org: {
        id: null,
        name: "",
        address1: "",
        address2: "",
        city: "",
        state: "",
        postal_code: "",
        url: "",
        partner_type: "",
        partner_id: "",
        contact_technical_name: "",
        contact_technical_email: "",
        contact_technical_phone: "",
        contact_commercial_name: "",
        contact_commercial_email: "",
        contact_commercial_phone: "",
      },
      error_message: null,
      error_message_global: "",
      submitted: false,
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
    save() {
      var data = {
        name: this.org.name,
        address1: this.org.address1,
        address2: this.org.address2,
        city: this.org.city,
        state: this.org.state,
        postal_code: this.org.postal_code,
        url: this.org.url,
        partner_type: this.org.partner_type,
        partner_id: this.org.partner_id,
        contact_technical_name: this.org.contact_technical_name,
        contact_technical_email: this.org.contact_technical_email,
        contact_technical_phone: this.org.contact_technical_phone,
        contact_commercial_name: this.org.contact_commercial_name,
        contact_commercial_email: this.org.contact_commercial_email,
        contact_commercial_phone: this.org.contact_commercial_phone,
      };

      OrganizationService.create(data)
        .then((response) => {
          this.org.id = response.data.id;
          this.submitted = true;
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

    newOrg() {
      this.submitted = false;
      this.org = {};
      this.error_message = "";
    },
  },
};
</script>
<style>
</style>
