<?php
if (Message::hasMessage(Message::Error)) {
    ?>
    <section class="bg-danger rounded p-3 m-3">
        <h1 class="m-0">Error</h1>
        <p class="m-0"><?php echo Message::fetchMessage(Message::Error) ?></p>
    </section>
    <?php
}
if (Message::hasMessage(Message::Warning)) {
    ?>
    <section class="bg-warning rounded p-3 m-3">
        <h1 class="m-0">Warning</h1>
        <p class="m-0"><?php echo Message::fetchMessage(Message::Warning) ?></p>
    </section>
    <?php
}
if (Message::hasMessage(Message::Succes)) {
    ?>
    <section class="bg-success rounded p-3 m-3">
        <h1 class="m-0">Succes</h1>
        <p class="m-0"><?php echo Message::fetchMessage(Message::Succes) ?></p>
    </section>
    <?php
}
if (Message::hasMessage(Message::Info)) {
    ?>
    <section class="bg-primary rounded p-3 m-3">
        <h1 class="m-0">Info</h1>
        <p class="m-0"><?php echo Message::fetchMessage(Message::Info) ?></p>
    </section>
    <?php
}