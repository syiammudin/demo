import VueRouter from 'vue-router'
// Pages
import Home from './pages/Home'
import Request from './pages/app/Request'
import User from './pages/app/User'
import MyProfile from './pages/app/MyProfile'
import FormAircraft from './pages/app/form_request/Aircraft'
import AppConfig from './pages/app/AppConfig'
import Testing from './pages/app/testing'

import FormFirstComponent from './pages/app/form_request/Component'
import FormComponent from './pages/app/form_request/component/ComponentMain'
// import ComponentForm from './pages/app/form_request/component/ComponentMainform'

import ChangeAction from './pages/app/form_request/changeAction'

import FormEngine from './pages/app/form_request/Engine'
import FormSpecial from './pages/app/form_request/Special'

import VendorManagement from './pages/app/vendor_management/vendormanagement'
import FormVendorManagement from './pages/app/vendor_management/FormVendorManagement'
import ApprovalVendor from './pages/app/vendor_management/approvalvendor'

import AircraftRequest from './pages/app/RequestList/AircraftRequest'
import ComponentRequest from './pages/app/RequestList/ComponentRequest'
import EngineRequest from './pages/app/RequestList/EngineRequest'
import SpecialRequest from './pages/app/RequestList/SpecialRequest'

import AprovalAircraft from './pages/app/AprovalRequest/Aproval_aircraft'
import AprovalEngine from './pages/app/AprovalRequest/Aproval_engine'
import AprovalSpecial from './pages/app/AprovalRequest/Aproval_special'
import AprovalComponent from './pages/app/AprovalRequest/Aproval_component'

import LineMaintenance from './pages/app/masterdata/LineMaintenance'
import BaseMaintenance from './pages/app/masterdata/base_maintenance'
import Workshop from './pages/app/masterdata/workshop'
import TyppeSupplier from './pages/app/masterdata/type_supplier'
import AircraftType from './pages/app/masterdata/AircraftType'
import PartNumber from './pages/app/masterdata/PartNumber'
import UnitOfMeasures from './pages/app/masterdata/UnitOfMeasures'
import MasterRequest from './pages/app/masterdata/MasterRequest'
import Questionare from './pages/app/masterdata/Questionare'
import NdtMethod from './pages/app/masterdata/NdtMethod'
import ForRating from './pages/app/masterdata/ForRating'
import CustomerAircraft from './pages/app/masterdata/CustomerAircraft'

import VendorCapability from './pages/app/CapabilityList/VendorCapability'
import ComponentCapability from './pages/app/CapabilityList/ComponentCapability'
import Report from './pages/report/report'

import Timeline from './pages/app/tracking/Timeline'
import DemoMedicalClaim from './pages/Demo/MedicalClaim'
import DemoNda from './pages/Demo/nda'

// Routes
const routes = [


  { path: '/medicalclaim', name: 'medicalclaim', component: DemoMedicalClaim },
  { path: '/nda', name: 'nda', component: DemoNda },


  { path: '/untuktesting', name: 'untuktesting', component: Testing },
  { path: '/', name: 'home', component: Home },
  { path: '/user', name: 'user', component: User },
  { path: '/app_config', name: 'app_config', component: AppConfig },
  { path: '/my_profile', name: 'my_profile', component: MyProfile },

  { path: '/request', name: 'request', component: Request },

  // LIST REQUEST
  { path: '/aircraft_request', name: 'aircraft_request', component: AircraftRequest },
  { path: '/component_request', name: 'component_request', component: ComponentRequest },
  { path: '/engine_requests', name: 'engine_requests', component: EngineRequest },
  { path: '/special_request', name: 'special_request', component: SpecialRequest },

  // APROVAL PROSES
  { path: '/aproval_aircraft', name: 'aproval_aircraft', component: AprovalAircraft },
  { path: '/aproval_engine', name: 'aproval_engine', component: AprovalEngine },
  { path: '/aproval_special', name: 'aproval_special', component: AprovalSpecial },
  { path: '/aproval_component', name: 'aproval_component', component: AprovalComponent },

  //FORM REQUEST
  { path: '/form_aircraft/:type', name: 'form_aircraft', component: FormAircraft,
    props: true
  },
  { path: '/form_aircraft/:title/:type', name: 'form_aircraft_change', component: ChangeAction,
    props: true
  },

  // component form
  { path: '/form_component', name: 'form_component', component: FormFirstComponent, },
  { path: '/form_component/:type', name: 'form_component_change', component: FormFirstComponent,
    props: true
  },
  { path: '/form_component/:type/:component_type', name: 'form_component_data', component: FormComponent,
    props: true
  },

  { path: '/form_engine/:type', name: 'form_engine', component: FormEngine,
    props: true
  },
  { path: '/form_engine/:title/:type', name: 'form_engine_change', component: ChangeAction,
    props: true
  },

  { path: '/form_special/:type', name: 'form_special', component: FormSpecial,
    props: true
  },
  { path: '/form_special/:title/:type', name: 'form_special_change', component: ChangeAction,
    props: true
  },

  { path: '/tracking/:type', name: 'tracking', component: Timeline,
    props: true
  },

  { path: '/vendor_management', name: 'vendor_management', component: VendorManagement },
  { path: '/aproval_vendor', name: 'aproval_vendor', component: ApprovalVendor },
  { path: '/form_vendor_management/:type', name: 'form_vendor_management', component: FormVendorManagement, props : true },

  // Master Data
  { path :'/line_maintenance', name :'line_maintenance', component: LineMaintenance } ,
  { path :'/base_maintenance', name :'base_maintenance', component: BaseMaintenance } ,
  { path :'/workshop', name :'workshop', component: Workshop } ,
  { path :'/type_supplier', name :'type_supplier', component: TyppeSupplier } ,
  { path :'/aircraft_type', name :'aircraft_type', component: AircraftType } ,
  { path :'/part_number', name :'part_number', component: PartNumber } ,
  { path :'/unit_of_measures', name :'unit_of_measures', component: UnitOfMeasures } ,
  { path :'/master_request', name :'master_request', component: MasterRequest } ,
  { path :'/questionare', name :'questionare', component: Questionare } ,
  { path :'/ndt_method', name :'ndt_method', component: NdtMethod } ,
  { path :'/for_rating', name :'for_rating', component: ForRating } ,
  { path :'/customer_aircraft', name :'customer_aircraft', component: CustomerAircraft } ,

  { path: '/vendor_capability', name: 'vendor_capability', component: VendorCapability },
  { path: '/component_capability', name: 'component_capability', component: ComponentCapability },

  { path: '/report/:type', name: 'report', component: Report, props: true },

]
const router = new VueRouter({
  // history: true,
  // mode: 'history',
  // base : APP_BASE + 'app' ,
  routes,
})

export default router
