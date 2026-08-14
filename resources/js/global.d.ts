type HttpStatusCode =
  | 200
  | 201
  | 204
  | 400
  | 401
  | 403
  | 404
  | 409
  | 422
  | 429
  | 500
  | 502
  | 503

declare module "@inertiajs/core" {
  export interface InertiaConfig {
    sharedPageProps: {
      auth: {
        user: {
          id: number;
          name: string;
        } | null;
      };
      appName: string;
      httpStatusCodes: HttpStatusCode
    };

    flashDataType: {
      toast?: {
        type: "success" | "error" | "warning" | "info";
        message: string;
        code: HttpStatusCode;
      };
    };

    errorValueType: string[];

    layoutProps: {
      title: string;
      showSidebar: boolean;
    };

    namedLayoutProps: {
      app: {
        title: string;
        theme: "light" | "dark";
      };
      content: {
        padding: string;
        maxWidth: string;
      };
    };
  }
}
