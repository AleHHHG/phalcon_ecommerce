<!DOCTYPE html>
<html>
    {{ partial("layouts/_head") }}
    <body>
      {{ partial("template/header") }}
      {{ content() }}
      {{ partial("template/footer") }}
    </body>
    {{ partial("layouts/_scripts") }}
</html>
