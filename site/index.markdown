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

<div class="row">
{% for post in site.posts %}
<div class="col-6">
  <div class="card">
    <div class="card-header p-0">
      <h3 class="card-title m-2" style="text-indent: 4px;">{{ post.title }}</h3>
    </div>
    <div class="card-body p-0">
      <img src="/assets/instance-banners/{{ post.banner }}">
      <p class="instance-description">Mastodon.Africa is run by South Africans, for South Africans.</p>
    </div>
    <div class="card-footer p-0">
      <div class="d-flex justify-content-between">
        <div class="p-2"><img src="/assets/flags/4x3/{{ post.country }}.svg" class="country-flag"></div>
        <div class="p-2"><span class="instance-stats">{{ post.users }} active users</span></div>
      </div>
    </div>
  </div>
</div>
{% endfor %}
</div>