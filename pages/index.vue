<template>
  <div class="min-h-screen bg-base-300 pb-5">
    <Navbar />
    <h1 class="text-5xl font-bold text-center py-5">Developer APIs</h1>
    <DocCard
      title="Single Button API"
      :ExampleUrl="SingleExampleUrl"
      :PreUrl="SinglePreUrl"
      :requireFtype="true"
      iframeId="singleButtonApi"
      :resizeJsCode="false"
    />
    <DocCard
      class="my-8"
      title="Multi Button API"
      :ExampleUrl="ButtonExampleUrl"
      :PreUrl="ButtonPreUrl"
      :requireFtype="true"
      iframeId="buttonApi"
      :resizeJsCode="true"
    />
    <DocCard
      class="my-8"
      title="Widget API"
      :ExampleUrl="WidgetExampleUrl"
      :PreUrl="WidgetPreUrl"
      :requireFtype="false"
      iframeId="widgetApi"
      :resizeJsCode="true"
    />
    <DocCard
      class="my-8"
      title="Widget v2 API"
      :ExampleUrl="Widgetv2ExampleUrl"
      :PreUrl="Widgetv2PreUrl"
      :requireFtype="false"
      iframeId="widgetv2Api"
      :resizeJsCode="true"
    />
  </div>
</template>

<script>
export default {
  data() {
    return {
      url: process.env.APP_DOMAIN,
      SingleExampleUrl:
        process.env.APP_DOMAIN + "/api/single/{FTYPE}?url={VIDEO_URL}",
      SinglePreUrl:
        process.env.APP_DOMAIN +
        "/api/single/mp3?url=https://www.youtube.com/watch?v=zvrMzRVtj1s",
      ButtonExampleUrl:
        process.env.APP_DOMAIN + "/api/button/{FTYPE}?url={VIDEO_URL}",
      ButtonPreUrl:
        process.env.APP_DOMAIN +
        "/api/button/mp3?url=https://www.youtube.com/watch?v=zvrMzRVtj1s",
      Widgetv2ExampleUrl:
        process.env.APP_DOMAIN + "/api/widgetv2?url={VIDEO_URL}",
      Widgetv2PreUrl:
        process.env.APP_DOMAIN +
        "/api/widgetv2?url=https://www.youtube.com/watch?v=zvrMzRVtj1s",
      WidgetExampleUrl:
        process.env.APP_DOMAIN + "/api/widget?url={VIDEO_URL}",
      WidgetPreUrl:
        process.env.APP_DOMAIN +
        "/api/widget?url=https://www.youtube.com/watch?v=zvrMzRVtj1s",
    };
  },
};
</script>
