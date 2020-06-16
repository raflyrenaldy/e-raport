<template>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-primary" v-if="message">
                {{ message }}
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Import Class Room</h4>
                </div>
                <div class="card-body p-0">
                    <div class="card">
                        <div style="border-radius: 25px;
background: linear-gradient(145deg, #5d6bd7, #6e7fff);
box-shadow:  41px 41px 82px #404a94,
             -41px -41px 82px #8ea4ff;margin-bottom: 25px;margin-left: 50px; margin-top:35px; margin-right:50px">
                            <div class="row">
                                <div class="col-md-6">
                                    <p style="color: white;margin-left:40px;margin-top: 45px">
                                        Create your new customer in here, enter the valid name and phone number your new
                                        customer.
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <center><img alt="image"
                                                 v-bind:src="$parent.MakeUrl('assets/svg/undraw_selecting_team_8uux.svg')"
                                                 width="180" style="margin-top:10px; margin-bottom:10px"
                                                 data-toggle="tooltip"
                                                 title=""></center>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="35%"
                                     class="demo-ruleForm">
                                <el-form-item label="Excel Class Room" prop="file_excel">
                                    <el-upload
                                        style="width:50%"
                                        type="file"
                                        class="upload-demo"
                                        action="https://jsonplaceholder.typicode.com/posts/"
                                        :auto-upload="false"
                                        :show-file-list="true"
                                        :multiple="false"
                                        :limit="1"
                                        :on-change="onUploadChangeVN"file>
                                        <el-button size="small" type="primary">Click to upload</el-button>
                                    </el-upload>
                                </el-form-item>

                                <el-form-item>
                                    <button type="button" v-bind:disabled="loadingAdd" class="btn btn-primary"
                                            @click="uploadModel('ruleForm')"><span
                                        v-if="loadingAdd">Uploading</span><span v-else>Upload</span></button>
                                </el-form-item>
                            </el-form>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Class Room</h4>
                </div>
                <div class="card-body p-0">
                   <div class="table-responsive table-invoice" v-if="!loading">
                        <table class="table table-striped" v-if="models.data.length">
                            <tbody>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Total</th>
                                <th>Created At</th>
                            </tr>
                            <tr v-for="model, index in models.data">
                                <td>{{ index+1 }}</td>
                                <td>{{ splitString(model.name) }} <br> {{ model.signature_id }}</td>
                                <td>{{ model.total }}</td>
                                <td>{{ model.created_at }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <div v-if="!models.data.length" class="text-center p-3 text-muted">
                            <h5>No Results</h5>
                            <p>Your search or filter, did not match any customers.</p>
                        </div>
                        <div class="card-footer text-right">
                            <nav class="d-inline-block">
                                <pagination :data="models" @pagination-change-page="loadModels"></pagination>
                            </nav>
                        </div>
                    </div>

                    <div class="card" v-else>
                        <div class="text-center p-4 text-muted">
                            <h5>Loading</h5>
                            <p>Please wait, data is being loaded...</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                ruleForm: {
                    file_excel: '',
                },
                loadingAdd: false,
                message: '',
                models: {},
                total: 0,
                loading: false,
                loadingmore: false,
                query: '',
                url: '',
                sorting: 0,
                status: 0,
                q: '',
                page: 1,
            }
        },
        mounted() {
            let query = location.search.split('query=')[1];
            if (query !== undefined) {
                this.query = query;
            }
            Fire.$on('searching', () => {
                this.query = this.$parent.search;
                this.page = 1;
                axios.get('class', {
                    params: {
                        q: this.query,
                        order: this.sorting == 0 ? '' : this.sorting,
                        page: this.page
                    }
                })
                    .then((response) => {
                        let res = response.data;
                        if (res.status) {
                            this.models = res.data;
                            this.total = res.data.total;
                            this.loading = false;
                        }
                    })
                    .catch(() => {
                        this.loading = false;
                    });
            });
            this.url = BaseUrl('admin/class', {
                params: {
                    q: this.query,
                    order: this.sorting == 0 ? '' : this.sorting,
                    status: this.status == 0 ? '' : this.status,
                    date: this.dates,
                    page: this.page
                }
            });
            this.loadModels();
        },
        methods: {
            clear() {
                this.ruleForm.file_excel = '';
            },
            onUploadChangeVN(file) {
                this.ruleForm.file_excel = file.raw;
                // var reader = new FileReader();
                //
                // reader.readAsDataURL(file.raw);
                // reader.onload = (e) => {
                //     this.ruleForm.file_excel = e.target.result;
                // }
            },
            async modelsList(isLoading = true) {
                let _this = this;
                _this.loading = isLoading;
                this.page = 1;
                axios.get('class', {
                    params: {
                        q: this.query,
                        order: this.sorting == 0 ? '' : this.sorting,
                        page: this.page
                    }
                }).then((response) => {
                    let res = response.data;
                    if (res.status) {
                        _this.models = _this.models = res.data;
                        _this.total = res.data.total;
                        _this.loading = false;
                        _this.page = _this.page + 1;
                    }
                }).catch((err) => {
                    _this.loading = false;
                });
            },
            async loadModels(page) {
                let _this = this;
                _this.loading = true;
                if (typeof page === 'undefined') {
                    page = 1;
                }
                this.page = page;
                axios.get('class', {
                    params: {
                        q: _this.query,
                        order: _this.sorting == 0 ? '' : _this.sorting,
                        page: _this.page
                    }
                }).then((response) => {
                    let res = response.data;
                    if (res.status) {
                        _this.models = res.data;
                        _this.total = res.data.total;
                        _this.loading = false;
                    }
                }).catch((err) => {
                    _this.loading = false;
                });
            },
            uploadModel(formName) {
                // console.log(formName);
                this.loadingAdd = true;
                this.$refs[formName].validate((valid) => {
                    console.log(valid);
                    if (valid) {
                        let _this = this;
                        _this.errors = [];
                        _this.message = '';
                        _this.loadingAdd = true;
                        let param = new FormData();
                        console.log(this.ruleForm.file_excel)
                        param.append("file_excel", this.ruleForm.file_excel);
                        axios.post(this.$parent.MakeUrl('admin/class/upload/'), param, {
                                headers: {
                                    "Content-Type": "multipart/form-data"
                                }
                            }).then((response) => {
                            let res = response.data;
                            if (res.status) {
                                _this.loadingAdd = false;
                                _this.message = 'Class room already uploaded';
                                _this.loadModels(1)
                                _this.clear
                            } else {
                                _this.loadingAdd = false;
                                _this.message = res.message;
                            }

                        }).catch((err) => {
                            _this.errors = err.response.data.errors;
                            _this.loadingAdd = false;
                        });
                    } else {
                        this.loadingAdd = false;
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            splitString(value) {
                let string = value.split(" ");
                    let string1 = string[1] ? string[1] : ''
                    let newString = string[0] + ' ' + string1;

                return newString;
            },
        }
    }
</script>
