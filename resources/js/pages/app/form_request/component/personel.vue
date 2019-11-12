<template >
<div class="" >
    <div class="form-horizontal">
        <div class="form-group">
            <label class="label-control col-lg-3">Name </label>
            <div class="col-lg-9">
                <el-select @change="getAtributePersonel()" :remote-method="searchPersonel" v-model="input.name" filterable remote clearable placeholder="Select Name" >
                    <el-option v-for="data in personelList " :key='data.nopeg' :label="data.nama+' | '+ data.nopeg" :value="data.nama"> </el-option>
                </el-select>
                <span v-if="err.name" > {{ err.name[0] }}</span>
            </div>
        </div>
        <div class="form-group">
            <label class="label-control col-lg-3">ID Number </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" readonly v-model='input.id_number' placeholder="ID NUMBER">
                <span v-if="err.id_number" > {{ err.id_number[0] }}</span>
            </div>
        </div>
        <div class="form-group">
            <label class="label-control col-lg-3">Nominate </label>
            <div class="col-lg-9">
                <el-select  v-model="input.nominate"  clearable placeholder="Select Request type" >
                    <el-option label="Nominated Certifying Staff" value="Nominated Certifying Staff"> </el-option>
                    <el-option label="Nominated Technician" value="Nominated Technician"> </el-option>
                </el-select>
                <span v-if="err.nominate" > {{ err.nominate[0] }}</span>
            </div>
        </div>
        <div class="form-group" v-if="input.nominate == 'Nominated Certifying Staff'">
            <label class="label-control col-lg-3" >Component Training Certificate</label>
            <div class="col-lg-9 row">
                <div class="col-lg-12">
                    <el-upload class="upload-demo" :action="url + '/attachment'" :on-success="trainingCertificate"
                    :on-change="handleChange"
                    :on-remove="handleRemove"
                    :file-list="fileList"
                     :before-upload="beforeAvatarUpload"
                    >
                        <el-button size="mini" type="primary"><i class="fa fa-file"></i> Upload</el-button>
                    </el-upload>
                </div>
                <span v-if="err.training_certificate" > {{ err.training_certificate[0] }}</span>
            </div>
        </div>
        <div class="form-group" v-if="input.nominate == 'Nominated Certifying Staff'">
            <label class="label-control col-lg-3">Certifying Staff Authorization (*)</label>
            <div class="col-lg-9 row">
                <div class="col-lg-12">
                    <el-upload class="upload-demo" :action="url + '/attachment'" :on-success="staffauthorization"
                    :on-change="handleChange"
                    :on-remove="handleRemove"
                    :file-list="fileList"
                     :before-upload="beforeAvatarUpload"
                    >
                      <el-button size="mini" type="primary"><i class="fa fa-file"></i> Upload</el-button>
                    </el-upload>
                </div>
                <span v-if="err.staff_authorization" > {{ err.staff_authorization[0] }}</span>
            </div>
        </div>
        <div class="form-group" v-if="input.nominate != null">
            <label class="label-control col-lg-3">Certificate of Competence (*)</label>
            <div class="col-lg-9 row">
                <div class="col-lg-12">
                    <el-upload class="upload-demo" :action="url + '/attachment'" :on-success="certificatecompetence"
                    :on-change="handleChange"
                    :on-remove="handleRemove"
                    :file-list="fileList"
                     :before-upload="beforeAvatarUpload"
                    >
                        <el-button size="mini" type="primary"><i class="fa fa-file"></i> Upload</el-button>
                    </el-upload>
                </div>
                <span v-if="err.certificate_competence" > {{ err.certificate_competence[0] }}</span>
            </div>
        </div>
        <div class="form-group" v-if="input.nominate != null">
            <label class="label-control col-lg-3"> Personal Ability List {{ role_request == 3 ? '' : '(*)'}} </label>
            <div class="col-lg-9 row">
                <div class="col-lg-12">
                    <el-upload class="upload-demo" :action="url + '/attachment'" :on-success="personelability"
                    :on-change="handleChange"
                    :on-remove="handleRemove"
                    :file-list="fileList"
                     :before-upload="beforeAvatarUpload"
                    >
                        <el-button size="mini" type="primary"><i class="fa fa-file"></i> Upload</el-button>
                    </el-upload>
                </div>
                <span v-if="err.personal_ability" > {{ err.personal_ability[0] }}</span>
            </div>
        </div>
        <div class="line-dashed"> </div>
        <div class="form-group">
            <label class="col-lg-3"></label>
            <div class="col-lg-9">
                <el-button @click="id == null ? save() : update()" round icon="fa fa-plus" type="success"> {{ id == null ? 'Add' : 'Update' }} </el-button>
            </div>
        </div>
    </div>
    (*) Mandatory Item
</div>
</template>

<script>
export default {
    props : ['id_request', 'id','index_personel','list_personel','getdatapersonel'],
    data(){
        return {
            input : {}, personelDialog : false, url : BASE_URL +'submit_component_personel',  attach : {} ,fileList : [] ,
            personelList: [] , err : [], role_request : ROLE_REQUEST,
            dataPersonel : [] , loading : true
        }
    },
    mounted(){
      this.getData()
      this.getPersonel()
    },
    methods : {
        getAtributePersonel(){
          this.input.id_number = this.dataPersonel.find(s => s.nama == this.input.name ).nopeg
        },
        getPersonel(){
           this.dataPersonel = this.getdatapersonel
           this.loading = false
        },
        getData(){
          if(this.id == null){
            return
          }
          if(this.id != null){
            axios.get(this.url+'/'+this.id).then((res) => {
                this.input = res.data
                console.log(res.data);
            })
          }
        },
        update(){
          axios.put(this.url+'/'+this.id, this.input).then((res) => {
              if(res.data.status == 1){
                  this.$message({  type: 'success', message: 'Add '+this.input.name+' Success'  });
                  this.input.index_personel = this.index_personel
                  this.$emit('addPersonel', this.input )
                  this.fileList = []
                  this.input = {}
              }else{
                  this.$alert(res.data.message, 'Warning', {
                    confirmButtonText: 'OK',
                  });
              }
          })
          .catch((error) => {
              this.err = error.response.data.errors
          })
        },
        beforeAvatarUpload(file) {
            const isPDF = file.type === 'application/pdf';

            if (!isPDF) {
              this.$message.error('Type File must be PDF format!');
            }
            return isPDF;
        },
        handleChange(file, fileList){
            if(file.response != null){
                this.attach.attachment = file.response.file
                if(fileList.length > 1){
                    axios.post(this.url+'/action_file', fileList[0].response ).then((res) => {
                        this.fileList = fileList.slice(-1);
                    })
                    .catch((err) => {

                    })
                }
            }
        },
        handleRemove(file, fileList){
            axios.post(this.url+'/action_file', {'file' : file.response.file } ).then((res) => {
                console.log(res.data);
            })
            .catch((err) => {

            })
        },
        trainingCertificate(response, file, fileList) {
            this.input.training_certificate = response.file
        },
        staffauthorization(response, file, fileList) {
            this.input.staff_authorization = response.file
        },
        certificatecompetence(response, file, fileList) {
            this.input.certificate_competence = response.file
        },
        personelability(response, file, fileList) {
            this.input.personal_ability = response.file
        },

        trainingcertificate(response, file, fileList) {
            if(response.success == true){
                this.list_document[response.index].attachment = response.file
            }else{
                this.$message.error(response.message);
            }
        },
        searchPersonel(q) {
            if (q.length >= 3) {
                this.personelList = this.dataPersonel
                .filter(s => s.nama.toLowerCase().includes(q.toLowerCase()) ||  s.nopeg.toLowerCase().includes(q.toLowerCase()) )
                .filter(data => this.list_personel.findIndex(a => a.id_number == data.nopeg) == -1)
            }
        },
        delTrainingCertificate(){
            this.training_certificate = ''
        },
        delStaffAuthorization(){
            this.staff_authorization = ''
        },
        delCertificateCompetence(){
            this.certificate_competence = ''
        },
        delPersonalAbility(){
            this.personal_ability = ''
        },

        addPersonel(data) {
            this.input.name = data.full_name
            this.input.id_number = data.personel_number
        },
        save(){
          this.input.request_submittion_id = this.id_request
          if(this.input.personal_ability == null && this.role_request != 3){
              this.$alert("Please Attach one of the Personal Ability", 'Warning', {
                  confirmButtonText: 'OK',
              });
              return ''
          }
          if(this.input.certificate_competence == null){
              this.$alert("Please Attach Certificate Competence", 'Warning', {
                  confirmButtonText: 'OK',
              });
          }
          if(this.input.staff_authorization == null && this.input.nominate == 'Nominated Certifying Staff'){
              this.$alert("Please Attach Staff Authorization Certificate", 'Warning', {
                  confirmButtonText: 'OK',
              });
          }

          if(
            (this.input.certificate_competence != null  && this.input.nominate == 'Nominated Technician')
            || (this.input.staff_authorization != null && this.input.certificate_competence != null && this.input.nominate == 'Nominated Certifying Staff')
            ){
                axios.post(this.url, this.input).then((res) => {
                  if(res.data.status == 1){
                    this.$message({  type: 'success', message: 'Add '+this.input.name+' Success'  });
                    this.fileList = []
                    this.$emit('addPersonel', res.data.data )
                    this.input = {}
                  }else{
                    this.$alert(res.data.message, 'Warning', {
                      confirmButtonText: 'OK',
                    });
                  }
                })
                .catch((error) => {
                  this.err = error.response.data.errors
                })

            }
        }

    }
}
</script>

<style lang="css">
</style>
