<?php use App\Service\Page\PageService;?>
<!DOCTYPE html>
<html lang="en">

<?php (new PageService())->getPart(['head'], $data); ?>

<body class="bg-body-tertiary">

<?php (new PageService())->getPart(['navbar']); ?>


    <main class="container">

        <div class="d-flex align-items-center p-3 my-3 text-white bg-purple rounded shadow-sm">

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" data-bs-whatever="Create">Add new message</button>
        </div>

        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <h6 class="border-bottom pb-2 mb-0">Suggestions</h6>
            <div id="list">
                <!-- Message -->
            </div>
        </div>

        <!-- Modal Window Create Start -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="createModalLabel">Create Message</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="create-title-name" class="col-form-label">Title:</label>
                                <input type="text" class="form-control" name="createTitle" id="createTitle">
                            </div>
                            <div class="mb-3">
                                <label for="create-content-text" class="col-form-label">Content:</label>
                                <textarea class="form-control" name="createContent" id="createContent"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="createMessage">Send message</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Window Create End -->


        <!-- Modal Window Update Start -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="updateModalLabel">Update Message</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="updateTitle" class="col-form-label">Title:</label>
                                <input type="text" class="form-control" id="updateTitle">
                            </div>
                            <div class="mb-3">
                                <label for="updateContent" class="col-form-label">Content:</label>
                                <textarea class="form-control" id="updateContent"></textarea>
                            </div>
                            <input type="hidden" id="hiddenUpdateId">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="updateMessage">Send message</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Window Update End -->


        <!-- Modal Window Delete Start -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteModalLabel">Delete Message</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Do you really want to delete ?
                    </div>
                    <input type="hidden" id="hiddenDeleteId">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="deleteMessage">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Window Delete End -->

    </main>


    <?php (new PageService())->getPart(['footer']); ?>

</body>

</html>

</html>
