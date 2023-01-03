---
layout: default
title: Welcome!
---

<style type="text/css">

   img.country-flag {
    height: 18px;
   }

   p.instance-description {
    font-size: 12px;
    margin: 8px;
   }

   span.instance-stats {
     opacity: 0.7;
     font-size: 12px;
   }

</style>

<h1 class="mb-2">Instances hosted inside Africa</h1>

<p>These instances are physically located within the borders of an African country.</p>

<div class="row">
{% for post in site.posts reversed %}
{% if post.continent == "af" %}
<div class="col-4">
  <div class="card mb-4">
    <div class="card-header p-0">
      <h3 class="card-title m-2" style="text-indent: 4px;"><a href="https://{{ post.title }}" target="_blank">{{ post.title }} &raquo;</a></h3>
    </div>
    <div class="card-body p-0">
      <a href="https://{{ post.title }}" target="_blank"><div style="background: url('{{ post.banner }}') center center no-repeat; background-size: cover; height: 150px;"></div></a>
      <p class="instance-description" style="height: 36px; overflow: hidden;">{{ post.description }}</p>
    </div>
    <div class="card-footer p-0">
      <div class="d-flex justify-content-between">
        <div class="p-2"><img src="/assets/flags/4x3/{{ post.country }}.svg" class="country-flag" title="{{ post.country_name }}"></div>
        <div class="p-2"><span class="instance-stats">{{ post.statuses }} posts from {{ post.users }} users</span></div>
      </div>
    </div>
  </div>
</div>
{% endif %}
{% endfor %}
</div>

<p>&nbsp;</p>

<hr>

<h1 class="mb-2">Instances hosted outside Africa</h1>

<p>These instances are physically located outside of Africa, but are owned and operated by African instance administrators.</p>

<div class="row">
{% for post in site.posts reversed %}
{% if post.continent != "af" %}
<div class="col-4">
  <div class="card mb-4">
    <div class="card-header p-0">
      <h3 class="card-title m-2" style="text-indent: 4px;"><a href="https://{{ post.title }}" target="_blank">{{ post.title }} &raquo;</a></h3>
    </div>
    <div class="card-body p-0">
      <a href="https://{{ post.title }}" target="_blank"><img src="{{ post.banner }}"></a>
      <p class="instance-description">{{ post.description }}</p>
    </div>
    <div class="card-footer p-0">
      <div class="d-flex justify-content-between">
        <div class="p-2"><img src="/assets/flags/4x3/{{ post.country }}.svg" class="country-flag"></div>
        <div class="p-2"><span class="instance-stats">{{ post.statuses }} posts from {{ post.users }} users</span></div>
      </div>
    </div>
  </div>
</div>
{% endif %}
{% endfor %}
</div>
