        <!-- ------------------------------------------------------------------------posts modal start  -->
        <div id="post-modal">
            <div id="insert-post-modal-form">
                <div class="modal-title text-center">
                    <p>Create Post</p>
                </div>
                <hr>
                <div class="w-100">
                    <form id="submit-post-form">
                        <div class="insert-post-modal-inner w-100">
                            <input type="text" name="post-title" placeholder="What's on your mind?" required>
                        </div>
                        <div class="insert-post-img">
                            <div class="custom-file mt-4">
                                <input type="file" class="custom-file-input" name="post-file" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" required>
                                <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
                            </div>
                            <input type="submit" name="submit-post" class="btn-block btn mt-2 btn-success" value="Submit">
                        </div>
                    </form>
                </div>
                <div id="close-btn">
                    <p>X</p>
                </div>
            </div>
        </div>