title->Service Operation
author->Matteo Merola
tags->IT Service Management, ITIL, Service Operation, Service Desk
image->/public/content/0842.jpg
---:endmetadata:---

The goals of Service Operation are to **co-ordinate and fulfill activities and processes** required to provide and manage services with a specified **agreed level**.

Service Operation can be optimized in two ways: with long-term incremental improvements or with short-term ongoing improvements. The first concern conceptual changes like the use of new tools or changes into the Design phase while the second regard small changes like tuning, training or staff transfer.

## Organizational basic concepts

There can be various way to organiza people in order to fulfill processes:

- **Function**: a *logical concept* that refers to the people and automated actions that fulfill a demarcated process, an activity or a combination of the two;
- **Group**: refers to peopele fulfilling *similar activities*;
- **Team**: a *more formal* type of group of people working together to *achieve a common goal*;
- **Department**: *formal organization structure* that filfills a specific series of demarcated activities;
- **Division**: a number of departments that are *clustered*;
- **Role**: refers to a *series of behaviour* or actions that are fulfilled in a specific context by an individual, team or group.

## Achieving balance and trade-offs of Service Operation
Procedures and activities take place in a continually changing environment. This can give rise to a conflict between maintaining the current situation and reacting to changes. For this, one of the key roles of Service Operation is to handle these contrasts and find the balance. Typical trade-offs in this phase are:

### The internal IT view vs. The external business view
The external IT view is about the way users and customers experience services. The internal IT view is about how the IT organization manages IT components and systems to provide services.
**Both views are necessary to provide services** and there is the need to find a correct balance between these two aspects.

![](/public/content/Screen-Shot-2015-02-03-at-7-08-37-PM.png)

### Stability vs. Responsiveness
On one hand, Service Operation must ensure that the IT infrastructure is stable and available, on the other hand it must recognize the business requirements and change IT.
A business department can win a contract by requiring additional IT services and more capacity so Service Operation must be responsive. But how to find this balance?

- **invest in adaptable technologies** and processes such as virtual server and application technology, for instance;
- **encourage integration** between service level management and the other Service Design processes;
- **involve IT** a.s.a.p. **in the change process** in case of business changes;
- have the Service Operation teams **provide input for the design **and the refining of architecture and IT services;
- implement and use service level management to **prevent that business and IT managers** and staff **negotiate agreements informally**.

### Service Quality vs. Service Costs
Many organizations are strongly pressured to enhance the service quality, while they have to reduce costs. Achieving this optimal balance is a key task of service management. Many organizations leave this task to Service Operation who often lack of authority. This task is more appropriate for Service Strategy or Service Design phase.
### Reactiveness vs. Proactiveness
A reactive organization does nothing until an external stimulus forces it to act. A proactive organization always looks for new opportunities to improve the current situation. An over- proactive attitude can be very costly and for an optimal result, reactive and proactive behavior must be well-balanced.

# Processes and activities
![](/public/content/Service-Operation-1.png)

## Event management process
 An event  is an occurrence that affects the IT infrastructure managment. The goal of this process is to survey all events that occur in order to monitor the regular performance and escalate unforeseen circumstances. Its activities are:

 - event taking place;
 - event reporting;
 - event detection;
 - event filtering;
 - event classification;
 - event correlation;
 - triggering;
 - reaction possibilities;
 - action assessment;
 - closing of the event.

## Incident management process
An incident can be any event that interrupts or can interrupt a service. Belong to this definition events like failures, questions or queries. The goal of this process is to restore failures as soon as possible and typical activities are:

- identifying;
- recording/logging;
- classifying;
- prioritizing;
- initial diagnosing;
- escalating;
- researching and diagnosing;
- resolving and restoring;
- closing.

## Problem management process
The goal is to analyze and resolve the causes of incidents. There is a contrast between reactive vs. proactive problem management. Main activities are all the activities needed for a diagnosis of the underlying cause of incidents. This process must ensure that the resolution is implemented through appropriate control procedures.

## Request management process
This process concerns with small changes that initially pass through the Service Desk and its main goals are:

- providing information to customers about availability of services;
- offering the users a channel where they can request and receive services;
- assist users with general information;
- providing standard service components such as licenses or service media.

## Access management process
This process is responsible to ensure the fruition of the service. Its goal is to allow authorized user and to limit access to services to unauthorized users. Its main activities are:

- verification;
- assigning rights;
- monitoring IDs;
- recording and tracing access;
- removing or restricting rights.

## Monitoring and control process
The goal of this process is to measure an activity and its benefits to determine whether results are within target. Thus, main activities are:

- monitoring;
- reporting;
- control.

## IT Operations process
This process is responsible of all the day-to-day operational activities like Console management, Operation bridge, Job scheduling, Backup, Restore and so on...
Other operational activities which IT Operations carry on are:

- Mainframe management;
- Server management and support;
- Network management;
- Storage and archiving;
- Database management;
- Directory services management;
- Desktop support;
- Middleware management;
- Internet/web management;
- Facility and computing center management;
- Information security management;
- Operational activities improvement.


# Organization of Service Operation
There are four function units that operate in this phase.
## Service Desk
It is a function unit with a number of staff members who deal with a variety of service events. It is a very important part of the organization's IT department and it must be the prime contact point for IT users. Its goal is to restore the "normal service" as soon as possible.
It leads to some advantages:

- increased accessibility due to a single contact;
- requests are resolved better and faster;
- increased customer satisfaction;
- business less negatively impacted;
- improved focus on service and proactive service approach.

It can be organized in two ways: a local service desk or a virtual service desk. The first way offers a centralized service while the second one can achieve the 24/7 operation and the specialization of the staff in service desk groups.

Staffing a service desk is not an easy task. In fact, the number of calls received and to manage can significantly fluctuate among different days or hours. In order to take into account this fluctuation, managers should consider both maximum and minimum number of calls.

Another problem in staffing a service desk is that there is a problem with staff skills which need to be very large in order to satisfy customer's needs. A possible solution to this problem is to structure a service desk in a three tier organization with a first-line of contact with users and a second- and third-line of more specialized (and fewer in number) experts.

Some metrics can be used to measure service desk performance. Soft metrics like users surveys are used to measure customer's satisfaction.

## Technical management
It is a group, a department or a team that is responsible to be the guard of technical knowledge and expertise and it takes care of actual resources needed to support ITSM Lifecycle.
It also offers technical expertise and general management of IT infrastructure.
Its general activities are:

- starting training programs;
- designing and carrying out training for users, service desk or other groups;
- reseraching and developing resolutions that may increase Service Portfolio or that may improve or automate IT operations.

## IT Operations management
IT Operations management is the **function** that is responsible for performing the day-to-day operational activities. It ensures that the agreed level of IT services is provided to the business.
It plays a dual role: it is responsible for implementation of the activities defined during Service Design (focused on maintaining the status quo and the stability of the IT infrastructure). IT operations must be also capable of continual adaptation to business requirements and demands.

## Application management
Application management is responsible for the management of the applications during their lifecycles.
It is a **function** executed by a department, a group or a team. It supports business processes by determining functional and management requirements for applications and it also contributes to decisions (**purchase** an application **or develop internally**). It integrates the **Application Management Lifecycle** with the **IT Service Management Lifecycle** of which is not an alternative.

![](/public/content/Screen-Shot-2015-02-03-at-8-29-54-PM.png)


# Roles
### Service Desk roles

- **Service Desk Manager**: reports to senior managers about any subject that can significantly impact the business;
- **Service desk supervisor**: ensures that staffing and skill levels are maintained;
- **Service desk analysts**: deliver first support by accepting calls;
- **Super user**: business users who act as a liaisons between business and IT.

### Technical management roles

- **Technical managers/Team leaders**: responsible for control and decision-making;
- **Technical analysts/Architects**: defining and maintaining knowledge on how systems are related and ensuring that dependencies are understood;
- **Technical operators**: performing day-to-day operational tasks.

### IT Operation management roles

- IT Operation manager;
- Shift leader;
- IT operation analysts;
- IT operators.

### Application management roles

- **Application managers and Team leaders**: responsible for the application mainainance department;
- **Application analysts and architects**: responsible for matching business requirements to technical specifications.

### Incident management roles

The **Incident manager** is responsible for:
- managing major incidents;
- developing and maintaining incident management systems;
- producing management information;
- driving the efficiency and effectiveness of the incident management process.

### Problem management roles

The **Problem manager** co-ordinates all problem management activities and is specifically responsible for:

- contact with all problem solution groups to accomplish quick solutions to problems within SLA targets;
- supervision and ownership of the Known Error Database;
- formal closure of all problem reports.

### Access management roles

Usually, no access manager is appointed by an organization. This process and the related policy are ususally defined and maintained by information security management and executed by various service operation functions, such as service desk, technical management and application management.

# Organization structures

There are several ways to organize Service Operation function.

### Organization by technical specialization

This organization type creates departments according to the technology, the skills and activities necessary to manage that technology.

### Organization by activity

This type of organization structure focuses on the fact that similar activities are performed on all technologies within an organization. People who perform similar activities (regardless of the technology) are grouped together.

### Organizing to manage process

In process-based organizations, people are organized in groups or departments that perform or manage a specific process. This type of organization structure should only be used if IT production management is responsible for more than IT production and only if IT production management can play the role of process owner for specific processes.
Process-based departments are only effective if they are capable of co-ordinating process execution throughout the entire organization.

### Organizing by geography

This structure is used only in following circumstances:

- computing centers are geographically spread out;
- various regions or countries possess different technologies or offer a different range of services;
- legislation differs per country or region;
- different standards apply depending on the country or region;
- there are cultural or language differences between the personnel.

### Hybrid organization structures

It is unlikely that IT production management will be focused around a single organizational structure. Most organizations use a technical specialization combined with some extra activity or process-based departments.

# Critical success factors

Some factors are considered critical during Service Operation:

- **Management support**: crucial to guarantee sufficient financing and resources;
- **Business support**: show transparency about successes and failures;
- **Hiring and retaining staff**: the correct number of staff with the correct skills is a condition for successful Service Operation;
- **Service management training**: a 'service management culture' must be created;
- **Appropriate tools**: execute service management processes effectively;
- **Test validity**: to improve the quality level of IT services;
- **Measuring and reporting**: useful to have clear guidelines.

# Risks

Consider the following risks:

- **Service loss**: the greatest risk run by Service Operation, can lead to a negative impact on staff;
- insufficient financing and resources;
- loss of momentum;
- loss of important staff;
- lack of management support.

# Resuming megamindmap

![](/public/content/Service-Operation.png)
