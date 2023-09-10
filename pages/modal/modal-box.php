<?php
    function form_setup($content,$header = null,$footer = null,$id = null){
        return "<main class=\"form-setup w-100 m-auto\" id=".$id."><div class=\"p-5\">".$header.$content."
        </div><div class=\"d-flex align-items-end border-top border-light-subtle px-5 py-3\">".$footer."<span class=\"text-body-secondary\">2023</span></div>
        </main>";
    }
?>