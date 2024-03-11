<form class="forms-sample p-3" action="<?= base_url('admin/action/create/document') ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="document_id" value="<?= isset($document['document_id']) ? $document['document_id'] : '' ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <input type="text" name="document_name" class="form-control" placeholder="Document Title" required="required" value="<?= isset($document['document_name']) ? $document['document_name'] : '' ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <input type="text" name="document_description" class="form-control" placeholder="Breif Description of Description" required="required" value="<?= isset($document['document_description']) ? $document['document_description'] : '' ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="mt-3">
                    <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                        <div class="d-flex">
                            <div class="wrapper ms-3">
                                <input type="file" name="link" class="file-upload-default">
                                <small class="text-muted mb-0"><?= isset($document['link']) ? $document['link'] : 'No Document Selected'?></small>
                            </div>
                        </div>
                        <div class="text-muted text-small">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary me-2 text-white">Submit</button>
        <button class="btn btn-light">Cancel</button>
    </div>
</form>