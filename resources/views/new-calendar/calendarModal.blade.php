    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <!-- Add a custom class for the modal size -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Choose Dates</h5>
                    <div class="d-flex justify-content-end">
                        <button class="bt-closeCalendar" onclick="closeModal()" ><i class="bi bi-x-circle-fill"></i></button>
                    </div>
                </div>
               
                <div class="d-flex justify-content-center">
                    <span class="msg" style="color: #7B9A6C; font-size: 18px;" id="messageSuccess"></span>
                </div>
                <div class="modal-body">
                    
                    <!-- Content of the child views goes here -->
                    <div id="calendar"></div>
                </div>
               
            </div>
        </div>
    </div>

<style>
.bt-closeCalendar {
    background: none;
    border: none;
    color: #7B9A6C;
    font-size: 25px;
    display: flex;
    position: sticky;
}
</style>

<script>
    function closeModal() {
        $('#exampleModal').modal('toggle')
    }
</script>
    <!-- FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    