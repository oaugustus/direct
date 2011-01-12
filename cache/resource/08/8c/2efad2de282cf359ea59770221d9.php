<?php

/* ui/web/index.html */
class __TwigTemplate_088c2efad2de282cf359ea59770221d9 extends Twig_Template
{
    public function display(array $context, array $blocks = array())
    {
        $context = array_merge($this->env->getGlobals(), $context);

        // line 1
        echo "<html>
<head>
    <title>";
        // line 3
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context['app']) ? $context['app'] : null), "name", array(), "any", false, 3), "html");
        echo "</title>
    <!-- CSS-->
    <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context['app']) ? $context['app'] : null), "lib", array(), "any", false, 5), "extjs", array(), "any", false, 5), "html");
        echo "resources/css/ext-all.css\" />

    <!-- Javascript-->
    <script type=\"text/javascript\" src=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context['app']) ? $context['app'] : null), "lib", array(), "any", false, 8), "extjs", array(), "any", false, 8), "html");
        echo "adapter/ext/ext-base.js\"></script>
    <script type=\"text/javascript\" src=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context['app']) ? $context['app'] : null), "lib", array(), "any", false, 9), "extjs", array(), "any", false, 9), "html");
        echo "ext-all-debug.js\"></script>

    <script type=\"text/javascript\" src=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context['app']) ? $context['app'] : null), "url", array(), "any", false, 11), "html");
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context['app']) ? $context['app'] : null), "api", array(), "any", false, 11), "resource", array(), "any", false, 11), "html");
        echo "\"></script>

    <!-- Instantiation of ExtDirect Api-->
    <script>
        Ext.Direct.addProvider(";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context['app']) ? $context['app'] : null), "api", array(), "any", false, 15), "variable", array(), "any", false, 15), "html");
        echo ");
    </script>

    <script>
        Ext.onReady(function(){
           var a = new Ext.FormPanel({
               title: 'Form test',
               renderTo: Ext.getBody(),
               padding: '8 8 8 8',
               width: 250,
               frame: true,
               labelWidth: 50,
               fileUpload: true,
               api:{
                   submit: Action.User.sendForm
               },
               listeners:{
                   'actionfailed' : function(){
                       alert('error');
                   },
                   'actioncomplete' : function(){
                       alert('success');
                   }
               },
               items:[
                   {
                       name: 'name',
                       fieldLabel: 'Name',
                       xtype: 'textfield',
                       anchor: '100%',
                       allowBlank: false
                   },
                   {
                       xtype: 'textfield',
                       inputType: 'file',
                       name: 'file'
                   }
               ],
               buttons:[
                   {
                       text: 'Submit',
                       handler: function(){
                           if (a.getForm().isValid()){
                              a.getForm().submit();
                           }
                       },
                       scope: this
                   }
               ]
           });
        });
    </script>
</head>
<body>

</body>
</html>";
    }

    public function getTemplateName()
    {
        return "ui/web/index.html";
    }
}
