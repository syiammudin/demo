import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        MaintenanceArea:[],
        Role:[],
        requestTypes: [],
        Status: [],
        Personel: [],
        RequestNumber: [],
        AircraftType: [],
        PartNumber: [],
        UnitOfMeasure: [],
        RoleRequest: [],
        ForRating: [],
        Tools: [],
        Soe : [],
        Notif : [],
        Hangar : [],
        Workshop : [],
        TypeSupplier : [],
        Questionare : [],
        type_of_request : '',
        MainFn : [],
        DetailSoe : [] ,
        PartNumberNew : [] ,
        nopeg : '',
        NdtMethods : '',
        checkPNComponent : '',
        checkPNEngine : '',
        Customer : '',
        Issue : '',
        shortCaplist : [],
        type_caplist : ''
    },
    mutations: {
        getMaintenanceArea(state) {
            axios.get(BASE_URL + 'store').then(r => {
                state.MaintenanceArea = r.data
            }).catch(e => {
                console.log(e);
            })
        },
        getRole(state) {
            axios.get(BASE_URL + 'store/1').then(r => {
                state.Role = r.data
            }).catch(e => {
                console.log(e);
            })
        },
        getStatus(state) {
            axios.get(BASE_URL + 'store/status/1').then(r => {
                state.Status = r.data
            }).catch(e => {
                console.log(e);
            })
        },
        getRequestType(state) {
            axios.get(BASE_URL + 'MasterRequest').then(r => {
                state.requestTypes = r.data
            }).catch(e => {
                console.log(e);
            })
        },
        getPersonel(state) {
            axios.get(BASE_URL + 'store/user_soe/1').then(r => {
                state.Personel = r.data
            }).catch(e => {
                console.log(e);
            })
        },
        getDetailSoe(state) {
            axios.get(BASE_URL + 'store/full_user_soe/'+state.nopeg).then(r => {
                state.DetailSoe = r.data
            }).catch(e => {
                console.log(e);
            })
        },
        getRequestNumber(state) {
            axios.get(BASE_URL + 'store/request_number/1?type='+ state.type_of_request).then(r => {
                state.RequestNumber = r.data
                console.log(state);
            }).catch(e => {
                console.log(e);
            })
        },
        getshortCaplist(state) {
            axios.get(BASE_URL + 'store/shortCaplist/1?type='+ state.type_caplist).then(r => {
                state.shortCaplist = r.data
                console.log(state);
            }).catch(e => {
                console.log(e);
            })
        },
        getAircraftType(state) {
            axios.get(BASE_URL + 'store/aircraft_type/1').then(r => {
                state.AircraftType = r.data
            }).catch(e => {
                console.log(e);
            })
        },
        getPartNumber(state) {
            axios.get(BASE_URL + 'store/part_number/1').then(r => {
                state.PartNumber = r.data
            }).catch(e => {
                console.log(e);
            })
        },
        getPartNumberNew(state) {
            axios.get(BASE_URL + 'store/PartNumberNew/1').then(r => {
                state.PartNumberNew = r.data
            }).catch(e => {
                console.log(e);
            })
        },
        getUnitOfMeasure(state) {
            axios.get(BASE_URL + 'store/unit_of_measures/1').then(r => {
                state.UnitOfMeasure = r.data
            }).catch(e => {
                console.log(e);
            })
        },
        getRoleRequest(state) {
            axios.get(BASE_URL + 'store/role_request/1').then(r => {
                state.RoleRequest = r.data
            }).catch(e => {
                console.log(e);
            })
        },
        getForRating(state) {
            axios.get(BASE_URL + 'store/for_rating/1').then(r => {
                state.ForRating = r.data
            }).catch(e => {
                console.log(e);
            })
        },
        getTools(state) {
            axios.get(BASE_URL + 'store/tools/1').then(r => {
                state.Tools = r.data
            }).catch(e => {
                console.log(e);
            })
        },
        getSoe(state) {
            axios.get(BASE_URL + 'store/user_soe/1').then(r => {
                state.Soe = r.data
            }).catch(e => {
                console.log(e);
            })
        },
        getNotif(state) {
            axios.get(BASE_URL + 'store/notification/1').then(r => {
                state.Notif = r.data
            }).catch(e => {
                console.log(e);
            })
        },
        getHangar(state) {
            axios.get(BASE_URL + 'store/hangar/1').then(r => {
                state.Hangar = r.data
            }).catch(e => {
                console.log(e);
            })
        },
        getWorkshop(state) {
            axios.get(BASE_URL + 'store/workshop/1').then(r => {
                state.Workshop = r.data
            }).catch(e => {
                console.log(e);
            })
        },
        getTypeSupplier(state) {
            axios.get(BASE_URL + 'store/type_supplier/1').then(r => {
                state.TypeSupplier = r.data
            }).catch(e => {
                console.log(e);
            })
        },
        getQuestionare(state) {
            axios.get(BASE_URL + 'store/questionare/1').then(r => {
                state.Questionare = r.data
            }).catch(e => {
                console.log(e);
            })
        },
        getMainFn(state) {
            axios.get(BASE_URL + 'store/main_fn/1').then(r => {
                state.MainFn = r.data
            }).catch(e => {
                console.log(e);
            })
        },
        getNdtMethods(state) {
            axios.get(BASE_URL + 'store/NdtMethods/1').then(r => {
                state.NdtMethods = r.data
            }).catch(e => {
                console.log(e);
            })
        },
        getcheckPNComponent(state) {
            axios.get(BASE_URL + 'store/checkPNComponent/1').then(r => {
                state.checkPNComponent = r.data
            }).catch(e => {
                console.log(e);
            })
        },
        getcheckPNEngine(state) {
            axios.get(BASE_URL + 'store/checkPNEngine/1').then(r => {
                state.checkPNEngine = r.data
            }).catch(e => {
                console.log(e);
            })
        },
        getCustomer(state) {
            axios.get(BASE_URL + 'store/Customer/1').then(r => {
                state.Customer = r.data
            }).catch(e => {
                console.log(e);
            })
        },
        getIssue(state) {
            axios.get(BASE_URL + 'store/Issue/1').then(r => {
                state.Issue = r.data
            }).catch(e => {
                console.log(e);
            })
        },
    }
})
