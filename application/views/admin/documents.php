<div class="content-wrapper">
  <div class="row">
    <div class="col-sm-12">
      <div class="home-tab">
        <div class="d-sm-flex align-items-center justify-content-between border-bottom">
          <div>
            <div class="btn-wrapper f-right">
              <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
              <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
              <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
            </div>
          </div>
        </div>
        <div class="tab-content tab-content-basic">
          <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-start">
                      <div>                      
                        <h4 class="card-title">Documents</h4>
                        <p class="card-description">
                        Documents<code>uploaded</code>
                      </div>
                      <div>
                        <a href="<?= base_url('admin/page/create/document/create') ?>" class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-account-plus"></i>Add Document</a>
                      </div>
                    </div>
                  </p>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Size</th>
                          <th>Created By</th>
                          <th>Created On</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>                    
                        <?php if (count($documents) > 0) : ?>
                          <?php foreach ($documents as $doc) : ?>
                            <tr>
                              <td class="py-1">
                                <?php
                                  $image = '';

                                  if($doc['type'] == '.jpg')
                                  {                                    
                                    $image = base_url('assets/admin/images/documents/jpg_1.jpg');
                                  }
                                  elseif($doc['type'] == '.doc' || $doc['type'] == '.docx')
                                  {                                    
                                    $image = base_url('assets/admin/images/documents/word_1.jpg');
                                  }
                                  elseif($doc['type'] == '.pdf')
                                  {                                  
                                    $image = base_url('assets/admin/images/documents/pdf_2.jpg');
                                  }
                                  else
                                  {                                  
                                    $image = base_url('assets/admin/images/documents/file.jpg');
                                  }
                                ?>
                                <img src="<?= $image ?>" alt="image">
                              </td>
                              <td>
                                <div>
                                    <h6> <a target="_blank" style="text-decoration:none" href="<?= base_url($doc['slug']) ?>"><?= $doc['title'] ?></a></h6>
                                    <p> <?= $doc['description'] ?></p>
                                </div>
                               
                              </td>
                              <td>
                                <div class="progress">
                                  <div class="progress-bar bg-<?= ($doc['size'] < 7) ? ($doc['size'] < 3) ? 'success' : 'warning' : 'danger'?>" role="progressbar" style="width: <?= ($doc['size'] / 10) * 100 ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                              <td>
                                <?= $doc['created_by'] ?>
                              </td>
                              <td>
                                <?= $doc['created_on'] ?>
                              </td>
                              <td>
                                  <a href="<?= base_url('admin/page/create/document/' . $doc['document_id']) ?>">
                                      <div class="badge badge-opacity-success">Edit</div>
                                  </a>
                              </td>
                              <td>
                                  <a href="<?= base_url('admin/action/delete/document/' . $doc['document_id']) ?>">
                                      <div class="badge badge-opacity-danger">Delete</div>
                                  </a>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>