# MtRestBundle

The goal of this bundle is to provide a flexible API framework for building mature RESTful services.

### Architecture

The system is based upon an independent Core module which exports supported interfaces into the Bridge namespace.
The Bridge provides support for dependency inversion and common base types.
Environment communicates to the core by registering runtime adapters and event listeners.

### API

Communication layer exports two independent modules for endpoints and resources definitions with separate security handlers.

* Endpoint
  * EndpointInterface
  * EndpointDefinitionInterface
  * EndpointLocatorInterface
* Resource
  * ResourceInterface
  * ResourceTypeInterface
  * ResourceDefinitionInterface
  * ResourceEntityInterface
  * ResourceFactoryInterface
* Request
  * RequestHandlerInterface
  * EndpointRequestInterface
  * ResourceQueryInterface
* Security
  * TokenInterface
  * ResourceOwnerInterface
  * HasOwnerInterface
  * AuthenticationAdapterInterface
  * AuthorizationAdapterInterface

#### What needs to be done

Support for hypertext
