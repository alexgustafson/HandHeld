//
//  HHFieldModel.h
//  ZHAW HandHeld
//
//  Created by Alexander Gustafson on 16.02.13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import <Foundation/Foundation.h>
#import "HHTemplateModel.h"
#import "SqLiteDatabaseManager.h"

@class SqLiteDatabaseManager;
@interface HHFieldModel : NSObject
{
    NSNumber *id;
    NSNumber *order_nr;
    NSNumber *fieldType;
    NSString *name;
    NSString *data;
    NSDictionary* children;
    NSString* fieldTypeName;
    
    SqLiteDatabaseManager* _dbManager;
        
}
@property (nonatomic, retain) NSNumber *id;
@property (nonatomic, retain) NSNumber *order_nr;
@property (nonatomic, retain) NSNumber *fieldType;
@property (nonatomic, retain) NSString *name;
@property (nonatomic, retain) NSString *data;
@property (nonatomic, retain) NSString *fieldTypeName;
@property (nonatomic, retain) NSDictionary *children;

-(UIImage *)getImageForResource;
-(UIColor *)getColor;


@end
