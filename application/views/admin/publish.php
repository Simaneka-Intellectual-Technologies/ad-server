<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    <div>
                        <div class="btn-wrapper f-right">
                            <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i>
                                Share</a>
                            <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
                            <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
                        </div>
                    </div>
                </div>
                <div class="tab-content tab-content-basic">

                    <div class="row flex-grow">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-start">
                                        <div>
                                            <h4 class="card-title card-title-dash">Advertisment Publishing</h4>
                                            <p class="card-subtitle card-subtitle-dash">The code which you can use in
                                                your site to retrieve the ads</p>
                                        </div>
                                        <div>
                                            <select name="language" class="form-control w-100 langaugeSelection"
                                                id="exampleFormControlSelect1">
                                                <option value="0" selected disabled>Programming Language</option>
                                                <option value="js">Javascript</option>
                                                <option value="axios">React Axios</option>
                                                <option value="php">PHP</option>
                                                <option value="dart">Dart</option>
                                                <option value="curl">Curl</option>
                                                <option value="python">Phython</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <pre data-dependencies="css"><code class="language-javascript codeArea">Select Language on down                                    </code>
                                    </pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        const langaugeSelecter = document.querySelector('.langaugeSelection'),
            codeArea = document.querySelector('.codeArea')

        langaugeSelecter.addEventListener('change', (e) => {

            fetch('<?= base_url('assets/code/') ?>' + e.target.value)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(data => {
                    // Handle the JSON response data
                    codeArea.innerHTML = data;
                    Prism.highlightAll()
                })
                .catch(error => {
                    // Handle errors
                    console.error('There was a problem with the fetch operation:', error);
                });

        })
    </script>
    <!-- content-wrapper ends -->