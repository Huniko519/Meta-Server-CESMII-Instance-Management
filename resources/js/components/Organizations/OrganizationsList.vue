<template>
  <div class="page-size-wrapper">
    Show &nbsp;
    <select v-on:change="onPageSizeChanged" id="page-size">
      <option value="10" selected="">10</option>
      <option value="20">20</option>
      <option value="30">30</option>
      <option value="40">40</option>
    </select>
    &nbsp; entries
    <div class="control-group">
      <div class="row">
        <div class="col-md-5">
          <router-link :to="'/organizations/create'" class="btn btn-outline-secondary">
            Add New Org
          </router-link>
        </div>
        <div class="col-md-7">
          <div class="input-group mb-3">
            <label>Search: &nbsp;</label>
            <input type="text" class="form-control" placeholder=""
              @keyup="searchByKeyword"
              v-model="keyword"/>
          </div>
        </div>
      </div>
    </div>
  </div>
  <ag-grid-vue style="height: 520px; margin-left: auto; margin-right:auto;"
        class="ag-theme-alpine"
        :columnDefs="columnDefs"
        @grid-ready="onGridReady"
        :defaultColDef="defaultColDef"
        :detailCellRendererParams="detailCellRendererParams"
        :masterDetail="true"
        :pagination="true"
        :paginationPageSize="paginationPageSize"
        :rowData="rowData.value">
  </ag-grid-vue>
</template>

<script>
import OrganizationService from "../../services/OrganizationService";
import {AgGridVue} from "ag-grid-vue3";
import {reactive, onMounted, ref} from "vue";
import ActionCellrenderer from "./actionCellRenderer.vue";
import 'ag-grid-community/dist/styles/ag-grid.css';
import 'ag-grid-community/dist/styles/ag-theme-alpine.css';
import 'ag-grid-enterprise';

export default {
  components: {
    AgGridVue,
    actionCellrenderer: ActionCellrenderer,
  },
  setup(props) {
    let rowData = reactive([]);

    return {
      orgs: [],
      keyword: "",
      columnDefs: [
        { headerName: "Name", field: "name", cellRenderer: 'agGroupCellRenderer' },
        { headerName: "City", field: "city" },
        { headerName: "State", field: "state" },
        { headerName: "Type", field: "partner_type" },
        { 
          headerName: "Actions", 
          field: "action", 
          cellRenderer: 'actionCellrenderer' ,
          minWidth: 300
        },
      ],
      defaultColDef: {
        sortable: true,
        flex: 1,
        minWidth: 100,
        filter: true,
        resizable: true
      },
      paginationPageSize: null,
      gridApi: null,
      paginationNumberFormatter: null,
      rowData: rowData,
      detailCellRendererParams: {
        detailGridOptions: {
          // pagination: true,
          // paginationAutoPageSize: true,
          columnDefs: [
            { headerName: 'Instance Name', field: 'name' },
            { headerName: '', field: 'status' },
            { headerName: 'State', 
              field: 'state',
              cellRenderer: params => {
                if (params.value)
                  return '<div class="green-cross"></div>';
                else
                  return '<div class="red-cross"></div>';
              }
            },
            {
              headerName: "Action", 
              field: "action",
              minWidth: 250,
              cellRenderer: params => {
                return '<span><a href="/vms">Views</a></span>';
              }
            }
          ]
        },
        defaultColDef: {
          flex: 1,
        },
        getDetailRowData: (params) => {
          let data = [
            {"id": 1, "name": "IQC-10021-VMC", "status": "Requested", "state": false},
            {"id": 2, "name": "IQC-10021-VMC", "status": "Deployed", "state": true},
            {"id": 3, "name": "IQC-10021-VMC", "status": "Deployed", "state": false},
          ];
          params.successCallback(data);
        }
      }
    };
  },
  
  created() {
    this.paginationPageSize = 10;
    // this.paginationNumberFormatter = (params) => {
    //   return '[' + params.value.toLocaleString() +']';
    // }
  },
  methods: {
    onPageSizeChanged() {
      var value = document.getElementById('page-size').value;
      this.gridApi.paginationSetPageSize(Number(value));
      // this.paginationPageSize = Number(value);
    },
    retrieveOrgs() {
      OrganizationService.getAll()
        .then(response => {
          if (response.status = "Success") {
            this.rowData.value = response.data;
          }
        })
        .catch(e => {
          console.log(e);
        });
    },
    refreshList() {
      this.retrieveOrgs();
    },
    
    removeAllOrgs() {
      OrganizationService.deleteAll()
        .then(response => {
          this.refreshList();
        })
        .catch(e => {
          console.log(e);
        });
    },
    
    searchByKeyword() {
      OrganizationService.findByKeyword(this.keyword)
        .then(response => {
          this.rowData.value = response.data;
        })
        .catch(e => {
          console.log(e);
        });
    },
    onGridReady(params) {
      this.retrieveOrgs();
      this.gridApi = params.api;
      document.querySelector(".ag-paging-row-summary-panel").append("entries");
      document.querySelector(".ag-paging-row-summary-panel").prepend("Showing");
    },
  }
};
</script>
<style>
.list {
  text-align: left;
  max-width: 750px;
  margin: auto;
}
.page-size-wrapper {
  display: flex;
  padding-top: 40px;
  padding-bottom: 15px;
  align-items: center;
}

.control-group {
  position: absolute;
  right: 30px;
}

</style>