<form>
    <div class="row">
        <div class="col-sm-12">
            <article class="module">
                <header>
                    <h2>Live News</h2>
                </header>
                <section>
                    <div class="form-group">
                        <label for="liveNewsControl">Enable/Disable</label>
                        <br/>
                        <button type="button" class="btn btn-primary" id="liveNewsControl" data-toggle="button" aria-pressed="false" autocomplete="off">
                            Disabled
                        </button>
                    </div>
                    <div class="form-group">
                        <label for="liveNewsRibbon">Ribbon</label>
                        <input type="text" class="form-control" id="liveNewsRibbon">
                    </div>
                    <div class="form-group">
                        <label for="liveNewsTitle">Title</label>
                        <input type="text" class="form-control" id="liveNewsTitle">
                    </div>
                    <div class="form-group">
                        <label for="liveNewsCode">Live Code</label>
                        <textarea class="form-control" id="liveNewsCode"></textarea>
                    </div>
                    <button type="submit" class="btn margin-top btn-primary btn-lg">Publish</button>

                </section>
            </article>
        </div>
    </div>
</form>
<script>
    $(document).ready(function () {
        $("#liveNewsControl").click(function () {
            if ($(this).hasClass("active")) {
                $(this).html("Disabled");
            } else {
                $(this).html("Enabled");
            }
        });
    });
</script>
